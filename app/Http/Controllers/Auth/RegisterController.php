<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\OtpVerification;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function inscription(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ]);

        try {
            \DB::beginTransaction();

            // Créer l'utilisateur
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => true,
            ]);

            // Créer un profil vide
            $user->profile()->create([
                'is_public' => true
            ]);

            // Assigner le rôle client
            $roleClient = Role::firstOrCreate(['name' => 'client']);
            $user->assignRole($roleClient);

            // Générer l'OTP
            $otp = rand(100000, 999999);
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            // Envoyer l'OTP par email
            $user->notify(new OtpVerification($otp));

            event(new Registered($user));

            \DB::commit();

            // Connecter l'utilisateur
            auth()->login($user);

            // Forcer la redirection vers la vérification OTP
            return to_route('verification.notice')
                ->with('status', 'Un code de vérification a été envoyé à votre adresse email.');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Erreur inscription: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de l\'inscription.']);
        }
    }
}
