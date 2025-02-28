<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class SocialiteController extends Controller
{
    protected $providers = ["google"];

    protected function getGuzzleClient()
    {
        return new Client([
            'verify' => false,
            'timeout' => 30,
            'curl' => [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ]
        ]);
    }

    public function redirect(Request $request)
    {
        try {
            $provider = $request->provider;

            if (!in_array($provider, $this->providers)) {
                return redirect()->route('login')
                    ->with('error', 'Provider non autorisé');
            }

            return Socialite::driver($provider)
                ->setHttpClient($this->getGuzzleClient())
                ->stateless()
                ->with([
                    'prompt' => 'select_account',
                    'access_type' => 'offline',
                    'include_granted_scopes' => 'true'
                ])
                ->redirect();

        } catch (Exception $e) {
            Log::error('Google Redirect Error:', [
                'message' => $e->getMessage()
            ]);
            return redirect()->route('login')
                ->with('error', 'Erreur de connexion avec Google');
        }
    }

    public function callback(Request $request)
    {
        try {
            $provider = $request->provider;

            if (!in_array($provider, $this->providers)) {
                throw new Exception('Provider non autorisé');
            }

            $socialiteUser = Socialite::driver($provider)
                ->setHttpClient($this->getGuzzleClient())
                ->stateless()
                ->user();

            Log::info('Google user retrieved', [
                'email' => $socialiteUser->getEmail(),
                'name' => $socialiteUser->getName()
            ]);

            // Trouver ou créer l'utilisateur
            $user = User::updateOrCreate(
                ['email' => $socialiteUser->getEmail()],
                [
                    'name' => $socialiteUser->getName(),
                    'google_id' => $socialiteUser->getId(),
                    'email_verified_at' => now(),
                    'is_active' => true,
                    'password' => bcrypt(Str::random(16))
                ]
            );

            // Assigner le rôle client si c'est un nouvel utilisateur
            if ($user->wasRecentlyCreated) {
                $user->assignRole('client');
                Log::info('New user created and role assigned');
            }

            Log::info('User updated/created successfully', ['user_id' => $user->id]);

            // Authentification de l'utilisateur
            Auth::login($user, true);

            // Régénération de la session
            $request->session()->regenerate();

            // Force la sauvegarde de la session
            session()->save();

            Log::info('User authenticated', [
                'auth_check' => Auth::check(),
                'user_id' => Auth::id(),
                'session_id' => session()->getId()
            ]);

            // Vérification et redirection
            if (!$user->entreprises()->exists()) {
                Log::info('Redirecting to enterprise creation');
                return redirect()->intended(route('entreprise.create'))
                    ->with('status', 'Veuillez créer votre entreprise.');
            }

            Log::info('Redirecting to client space');
            return redirect()->intended(route('espaceClient'));

        } catch (Exception $e) {
            Log::error('Socialite Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->route('login')
                ->with('error', 'Une erreur est survenue lors de la connexion avec Google.');
        }
    }
}
