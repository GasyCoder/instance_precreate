<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->profile || !$user->profile->isComplete()) {
            session()->put('intended_url', $request->url());
            return redirect()->route('profile.edit')
                ->with('warning', 'Veuillez compléter votre profil pour continuer.');
        }

        // Si le profil est complet et que l'utilisateur essaie d'accéder à la page des plans
        // sans raison spécifique, rediriger vers l'espace client
        if ($request->routeIs('plans.selection') && !session()->has('require_plan_selection')) {
            return redirect()->route('espaceClient');
        }

        return $next($request);
    }
}
