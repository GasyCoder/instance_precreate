<?php

namespace App\Livewire\Client;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Instance;
use App\Models\Payment;
use App\Models\Subscription;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class HomeClient extends Component
{
    use WithPagination, LivewireAlert;

    public $currentPlan;
    public $plans;
    public $statistics;
    public $selectedInstance = null;
    public $perPage = 10;
    public $subscriptionEndDate;
    public $isLoading = true;
    public $showPlanSelection = false;

    public $instanceId;
    public $name;
    public $reference;
    public $created_at;
    public $expiration_date;
    public $status;
    public $planType;
    public $dolibarr_username;
    public $url;
    public $modules = [];

    public $currentDateTime;
    public $userLogin;
    public $search = '';

    protected $listeners = [
        'profileUpdated' => '$refresh',
        'upgradeInstance',
        'updateInstance'
    ];

    public function mount()
    {
        try {
            $this->user = Auth::user();
            if (!$this->user) {
                \Log::error('Utilisateur non authentifié dans HomeClient.');
                return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
            }

            $this->currentDateTime = now()->format('Y-m-d H:i:s');
            $this->userLogin = $this->user->name ?? 'Gasikara Digital';

            if (!$this->user->profile->isComplete()) {
                return redirect()->route('profile.edit')
                    ->with('warning', 'Veuillez compléter votre profil.');
            }

            $this->loadStatistics();
            // Ajuster pour gérer le cas où activePlan() retourne null
            $activePlanQuery = $this->user->activePlan();
            $this->currentPlan = $activePlanQuery ? $activePlanQuery->with('subscriptions.payment')->first() : null;
            $this->plans = Plan::all();
            $this->loadSubscriptionInfo();

        } catch (\Exception $e) {
            \Log::error('Erreur mount HomeClient:', ['error' => $e->getMessage()]);
            $this->alert('error', 'Une erreur est survenue lors du chargement de la page.');
        }
    }

    protected function prepareInstance($instance)
    {
        $subscription = $instance->subscription;
        $plan = $subscription?->plan;
        $subPlan = $subscription?->subPlan;
        $payment = $subscription?->payment;

        // Déterminer si l'instance est en trial (basé sur le status de la souscription)
        $instance->isTrialPeriod = $subscription->status === Subscription::STATUS_TRIAL && $subscription->end_date->isFuture();

        // Déterminer si l'instance est payante (active avec paiement complété)
        $instance->isPaid = $subscription->status === Subscription::STATUS_ACTIVE && $payment && $payment->status === Payment::STATUS_COMPLETED;

        // Capacités d'upgrade ou changement de plan
        $instance->canUpgrade = $instance->isTrialPeriod && $subscription->end_date->isFuture();
        $instance->canChangePlan = $subscription->status === Subscription::STATUS_ACTIVE && !$subscription->hasRecentlyChanged();

        // Calculer les jours restants pour le trial ou la durée pour les payants
        $instance->remainingTrialDays = $instance->isTrialPeriod ? now()->diffInDays($subscription->end_date) : 0;
        $instance->daysUntilChange = $subscription->daysUntilChangeAllowed();

        // Plan et sous-plan
        $instance->plan = $plan;
        $instance->subPlan = $subPlan;

        // Statut du paiement
        $instance->paymentStatus = $payment ? $payment->status : 'pending';

        // Déterminer si l'abonnement est annuel (basé sur la durée entre start_date et end_date)
        $instance->isAnnual = $subscription->getIsAnnualAttribute();

        // Mettre à jour le statut de l'instance dans la vue
        $instance->status = $instance->isPaid ? 'active' : ($instance->isTrialPeriod ? 'trial' : $instance->status);

        return $instance;
    }

    private function loadStatistics()
    {
        $this->statistics = [
            'totalInstances' => $this->user->instances()->count(),
            'activeInstances' => $this->user->instances()->active()->count(),
            'expiredInstances' => $this->user->instances()->expired()->count(),
            'paidInstances' => $this->user->instances()->paid()->count(),
        ];
    }

    private function loadSubscriptionInfo()
    {
        $activeSubscription = $this->user->subscriptions()
            ->whereIn('status', [Subscription::STATUS_ACTIVE, Subscription::STATUS_TRIAL])
            ->latest()
            ->first();

        $this->subscriptionEndDate = $activeSubscription?->end_date;
    }

    public function getFormattedEndDate()
    {
        if ($this->subscriptionEndDate) {
            Carbon::setLocale('fr');
            return Carbon::parse($this->subscriptionEndDate)->format('d/m/Y');
        }
        return '-';
    }

    public function delete($instanceId)
    {
        $instance = Instance::findOrFail($instanceId);
        $this->authorize('delete', $instance);
        $instance->delete();
        $this->alert('success', 'Instance supprimée avec succès.');
        $this->loadStatistics();
    }

    public function upgradeInstance($instanceId)
    {
        try {
            $instance = Instance::with(['subscription.plan.subPlans'])->findOrFail($instanceId);

            if (!$instance->subscription->canUpgrade()) {
                $this->alert('error', 'Cette instance ne peut pas être mise à niveau actuellement.');
                return;
            }

            $plan = $instance->subscription->plan;
            if (!$plan || ($plan->subPlans->isEmpty() && ($plan->price_monthly === null && $plan->price_yearly === null))) {
                \Log::error('Plan invalide ou sans prix ni sous-plans pour upgrade:', [
                    'instance_id' => $instanceId,
                    'plan_uuid' => $plan->uuid,
                    'plan_name' => $plan->name,
                    'price_monthly' => $plan->price_monthly,
                    'price_yearly' => $plan->price_yearly,
                ]);
                $this->alert('error', 'Le plan associé à cette instance n\'a pas de prix valides ni de sous-plans. Contactez l\'administration.');
                return;
            }

            // Charger un sous-plan par défaut si aucun n’est défini dans la souscription
            $selectedSubPlan = $instance->subscription->subPlan ?: $plan->subPlans->firstWhere('is_default', true) ?: $plan->subPlans->first();
            session([
                'selected_plan' => [
                    'uuid' => $plan->uuid,
                    'name' => $plan->name,
                    'is_trial' => true,
                    'instance_id' => $instance->id,
                    'upgrade_from_trial' => true,
                    'sub_plan_id' => $selectedSubPlan ? $selectedSubPlan->id : null
                ]
            ]);

            return redirect()->route('payment.upgrade', [
                'uuid' => $plan->uuid,
                'instance' => $instance->id,
                'sub_plan' => $selectedSubPlan ? $selectedSubPlan->id : null
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur upgradeInstance:', [
                'instance_id' => $instanceId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->alert('error', 'Une erreur est survenue lors de la mise à niveau.');
        }
    }

    public function updateInstance($instanceId)
    {
        try {
            $instance = Instance::with(['subscription.plan'])->findOrFail($instanceId);

            if ($instance->subscription->isTrialPeriod()) {
                return $this->upgradeInstance($instanceId);
            }

            if (!$instance->subscription->canChangePlan()) {
                $this->alert('error', "Vous pourrez changer d'offre dans {$instance->subscription->daysUntilChangeAllowed()} jours.");
                return;
            }

            session([
                'selected_plan' => [
                    'uuid' => $instance->subscription->plan->uuid,
                    'name' => $instance->subscription->plan->name,
                    'instance_id' => $instance->id,
                    'change_plan' => true
                ]
            ]);

            return redirect()->route('plans.selection', [
                'instance_id' => $instance->id,
                'change_plan' => true
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur updateInstance:', [
                'instance_id' => $instanceId,
                'error' => $e->getMessage()
            ]);
            $this->alert('error', 'Une erreur est survenue.');
        }
    }

    public function render()
    {
        try {
            $query = Instance::query()
                ->where('user_id', Auth::id())
                ->with(['subscription.plan', 'subscription.subPlan', 'subscription.payment']);

            if ($this->search) {
                $query->where(function($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('url', 'like', "%{$this->search}%")
                      ->orWhere('reference', 'like', "%{$this->search}%");
                });
            }

            $instances = $query->latest()->simplePaginate($this->perPage);
            $instances->through(fn ($instance) => $this->prepareInstance($instance));

            return view('livewire.client.home-client', [
                'instances' => $instances,
                'currentDateTime' => $this->currentDateTime,
                'userLogin' => $this->userLogin
            ])->layout('layouts.main');

        } catch (\Exception $e) {
            \Log::error('Erreur render HomeClient:', ['error' => $e->getMessage()]);

            return view('livewire.client.home-client', [
                'instances' => collect([]),
                'currentDateTime' => $this->currentDateTime,
                'userLogin' => $this->userLogin,
                'error' => 'Une erreur est survenue lors du chargement des données.'
            ])->layout('layouts.main');
        }
    }
}
