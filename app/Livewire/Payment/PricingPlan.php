<?php
namespace App\Livewire\Payment;

use App\Models\Plan;
use App\Models\User;
use App\Models\SubPlan;
use Livewire\Component;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PricingPlan extends Component
{
    use LivewireAlert;

    public $isYearly = true;
    public $currentPlan;
    public $selectedSubPlanId = null;

    public function mount()
    {
        /** @var User $user */
        $this->currentPlan = Auth::user()->activePlan();
    }

    public function selectSubPlan($planId, $subPlanId)
    {
        $this->selectedSubPlanId = $subPlanId;
        $this->dispatch('subPlanSelected', $subPlanId);
    }

    public function selectPlan($uuid)
    {
        try {
            $user = Auth::user();
            $plan = Plan::with('subPlans')->where('uuid', $uuid)->firstOrFail();

            // Vérifier si un sous-plan est requis
            if ($plan->has_sub_plans && !$this->selectedSubPlanId) {
                $this->alert('error', 'Veuillez sélectionner une option');
                return;
            }

            // Récupérer le sous-plan si sélectionné
            $subPlan = null;
            if ($this->selectedSubPlanId) {
                $subPlan = SubPlan::find($this->selectedSubPlanId);
                if (!$subPlan) {
                    $this->alert('error', 'Option invalide');
                    return;
                }
            }

            // Stocker les informations du plan dans la session
            session([
                'selected_plan' => [
                    'uuid' => $plan->uuid,
                    'name' => $plan->name,
                    'is_free' => $plan->is_free,
                    'sub_plan_id' => $subPlan?->id
                ]
            ]);

            // Si c'est un plan gratuit ou d'essai
            if ($plan->is_free) {
                session(['trial_activated' => true]);
                return redirect()->route('entreprise.create')
                    ->with('success', 'Plan gratuit activé. Créez maintenant votre entreprise.');
            }

            // Pour les plans payants, rediriger vers le processus de paiement
            return redirect()->route('payment.process', [
                'uuid' => $plan->uuid,
                'sub_plan' => $this->selectedSubPlanId
            ]);

        } catch (\Exception $e) {
            logger()->error('Erreur sélection plan:', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
                'plan_uuid' => $uuid
            ]);

            $this->alert('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }

    public function render()
    {
        return view('livewire.payment.pricing-plan', [
            'plans' => Plan::with(['subPlans' => function($query) {
                $query->orderBy('price_monthly', 'asc');
            }])
            ->orderBy('is_free', 'desc')
            ->get()
        ])->layout('layouts.main');
    }
}
