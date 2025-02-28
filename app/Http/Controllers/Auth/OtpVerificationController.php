<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\OtpVerification;

class OtpVerificationController extends Controller
{
    public function show()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('profile.edit');
        }
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        $user = auth()->user();

        // Convertir en string pour la comparaison
        if ((string)$user->otp !== (string)$request->otp) {
            return back()->withErrors(['otp' => 'Code OTP invalide.'])
                        ->withInput();
        }

        if (now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Code OTP expiré.'])
                        ->withInput();
        }

        try {
            // Marquer l'email comme vérifié
            $user->markEmailAsVerified();

            // Nettoyer l'OTP
            $user->update([
                'otp' => null,
                'otp_expires_at' => null
            ]);

            // Rediriger vers la mise à jour du profil
            return redirect()->route('profile.edit')
                ->with('status', 'Email vérifié avec succès. Veuillez compléter votre profil.');

        } catch (\Exception $e) {
            \Log::error('Erreur vérification OTP: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la vérification.']);
        }
    }

    public function resend(Request $request)
    {
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('profile.edit');
        }

        try {
            // Générer un nouveau OTP
            $otp = rand(100000, 999999);
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            // Renvoyer l'OTP
            $user->notify(new OtpVerification($otp));

            return back()->with('status', 'Un nouveau code de vérification a été envoyé.');

        } catch (\Exception $e) {
            \Log::error('Erreur renvoi OTP: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue lors du renvoi du code.']);
        }
    }
}
