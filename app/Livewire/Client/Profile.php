<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Profile extends Component
{
    use WithFileUploads;

    // Informations générales
    public $name;
    public $email;
    public $photo;

    // Changement de mot de passe
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // Statut du compte
    public $user;
    public $activePlan;
    public $remainingInstances;

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->activePlan = $this->user->activePlan();
        $this->remainingInstances = $this->user->remainingInstances();
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024'
        ]);
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        try {
            $this->user->update($validated);
            $this->dispatch('profile-updated');
            session()->flash('success', 'Profil mis à jour avec succès');
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la mise à jour du profil');
        }
    }

    public function updatePhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:1024'
        ]);

        try {
            // Génération d'un nom unique pour la photo
            $fileName = time() . '_' . $this->photo->getClientOriginalName();

            // Stockage de la nouvelle photo
            $path = $this->photo->storeAs('profile-photos', $fileName, 'public');

            // Suppression de l'ancienne photo si elle existe
            if ($this->user->profile_photo_path) {
                Storage::disk('public')->delete($this->user->profile_photo_path);
            }

            // Mise à jour du chemin dans la base de données
            $this->user->update([
                'profile_photo_path' => $path
            ]);

            // Réinitialisation
            $this->photo = null;

            // Refresh user instance
            $this->user = $this->user->fresh();

            $this->dispatch('photo-updated');
            session()->flash('success', 'Photo de profil mise à jour avec succès');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour de la photo');
        }
    }

    public function deletePhoto()
    {
        try {
            if ($this->user->profile_photo_path) {
                Storage::disk('public')->delete($this->user->profile_photo_path);
            }

            $this->user->update([
                'profile_photo_path' => null
            ]);

            $this->user = $this->user->fresh();
            $this->dispatch('photo-deleted');
            session()->flash('success', 'Photo de profil supprimée avec succès');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression de la photo');
        }
    }

    public function updatePassword()
    {
        $validated = $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'Le mot de passe actuel est incorrect.');
            return;
        }

        try {
            $this->user->update([
                'password' => Hash::make($this->new_password)
            ]);

            $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
            $this->dispatch('password-updated');
            session()->flash('success', 'Mot de passe modifié avec succès');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la modification du mot de passe');
        }
    }

    public function render()
    {
        return view('livewire.client.profile')->layout('layouts.homeClient');
    }
}
