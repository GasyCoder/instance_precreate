<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectAfterRegistration
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Ignorer certaines routes
        $allowedRoutes = [
            'verification.notice',
            'verification.verify',
            'verification.resend',
            'profile.edit',
            'profile.update',
            'entreprise.create',
            'plans.selection',
            'instance.create'
        ];

        if (in_array($request->route()->getName(), $allowedRoutes)) {
            return $next($request);
        }

        // Vérification de l'email
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        // Vérification du profil
        if (!$user->profile->isComplete()) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Veuillez compléter votre profil.');
        }


        return $next($request);
    }
}
