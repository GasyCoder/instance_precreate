<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile ?? $user->profile()->create([
            'user_id' => $user->id,
            'is_public' => true
        ]);

        return view('auth.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        try {
            $validated = $request->validate(Profile::rules($profile->id));
            $profile->update($validated);

            if ($profile->isComplete()) {
                // Ajouter le flag dans la session
                session(['profile_updated' => true]);

                return redirect()->route('espaceClient')
                    ->with('success', 'Profil mis à jour avec succès.');
            }

            return redirect()->route('profile.edit')
                ->with('warning', 'Veuillez compléter tous les champs obligatoires.');

        } catch (\Exception $e) {
            \Log::error('Erreur de mise à jour du profil: ' . $e->getMessage());

            return redirect()->route('profile.edit')
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
        }
    }

    public function checkCompletion()
    {
        $profile = auth()->user()->profile;

        return response()->json([
            'isComplete' => $profile->isComplete(),
            'missingFields' => [
                'fname' => empty($profile->fname),
                'lname' => empty($profile->lname),
                'telephone' => empty($profile->telephone)
            ]
        ]);
    }
}
