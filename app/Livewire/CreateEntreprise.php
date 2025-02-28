<?php
namespace App\Livewire;

use App\Models\Subscription;
use Livewire\Component;
use App\Models\Entreprise;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateEntreprise extends Component
{
    use WithPagination, LivewireAlert, AuthorizesRequests;

    public $name;
    public $nif;
    public $ville;
    public $pays;
    public $phone;
    public $adresse;
    public $employees_count;
    public $entreprises;
    public $showTerminerButton = false;
    public $showBackHeader = false;
    public $hasSubscription;

    protected $rules = [
        'name' => 'required|string|max:255',
        'nif' => 'nullable|string|unique:entreprises',
        'ville' => 'required|string|max:255',
        'pays' => 'nullable|string|max:255',
        'phone' => 'required|string|max:255',
        'adresse' => 'required|string',
        'employees_count' => 'required|string'
    ];

    public $infoMessage = [
        'title' => 'Étape importante',
        'content' => 'Avant de créer votre espace de travail, vous devez d\'abord configurer votre organisation. Cette étape est nécessaire pour personnaliser votre expérience.'
    ];

    public function mount()
    {
        $user = auth()->user();

        // Initialiser $this->entreprises comme une collection vide
        $this->entreprises = collect([]);

        // Vérifier si le profil est complet
        if (!$user->profile->isComplete()) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Veuillez compléter votre profil.');
        }

        // Vérifier si un plan est sélectionné
        if (!session()->has('selected_plan')) {
            return redirect()->route('plans.selection')
                ->with('warning', 'Veuillez sélectionner un plan.');
        }

        // Vérifier le paiement pour les plans payants
        $selectedPlan = session('selected_plan');
        if (!$selectedPlan['is_free'] && !session()->has('payment_completed') && !session()->has('trial_activated')) {
            return redirect()->route('payment.process', ['uuid' => $selectedPlan['uuid']])
                ->with('warning', 'Veuillez compléter le processus de paiement.');
        }

        // Charger les données
        $this->hasSubscription = $user->subscriptions()
            ->whereIn('status', ['active', 'trial'])
            ->exists();

            $this->entreprises = $user->entreprises()->get();
            $this->showTerminerButton = $this->entreprises->isNotEmpty();
            $this->showBackHeader = $this->entreprises->isNotEmpty() || $this->hasSubscription;

        // Gérer le message flash
        if (session()->has('status')) {
            $this->alert('success', session('status'));
        }
    }

    public function store()
    {
        $this->validate();

        try {
            $entreprise = auth()->user()->entreprises()->create([
                'name' => $this->name,
                'nif' => $this->nif,
                'ville' => $this->ville,
                'pays' => $this->pays ?? '',
                'phone' => $this->phone,
                'adresse' => $this->adresse,
                'employees_count' => $this->employees_count
            ]);

            // Mettre à jour la collection d'entreprises
            $this->entreprises = auth()->user()->entreprises()->get();

            // Activer les boutons
            $this->showTerminerButton = true;
            $this->showBackHeader = true;

            // Réinitialiser le formulaire
            $this->reset();

            // Message de succès
            $this->alert('success', 'Organisation ajoutée avec succès. Vous pouvez en ajouter une autre ou continuer vers l\'espace de travail.');
            return redirect()->route('entreprise.create');

        } catch (\Exception $e) {
            logger()->error('Erreur création entreprise:', ['error' => $e->getMessage()]);
            $this->alert('error', 'Erreur lors de l\'ajout: ' . $e->getMessage());
        }
    }

    public function terminer()
    {
        if ($this->entreprises->isEmpty()) {
            $this->alert('warning', 'Veuillez ajouter au moins une organisation avant de continuer.');
            return;
        }

        return redirect()->route('instance.create')
            ->with('success', 'Vous pouvez maintenant créer votre instance.');
    }


    public function render()
    {
        return view('livewire.create-entreprise', [
            'nextStep' => 'instance',
            'infoMessage' => $this->infoMessage,
            'entreprises' => $this->entreprises ?? collect([])
        ])->layout('layouts.main');
    }
}
