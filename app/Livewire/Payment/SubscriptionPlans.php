<?php

namespace App\Livewire\Payment;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubscriptionPlans extends Component
{
    public $plans;
    public $currentPlan;
    public $remainingInstances;

    public function mount()
    {
        $user = Auth::user();
        $this->plans = Plan::where('is_free', false)->get();
        $this->currentPlan = $user->activePlan();
        $this->remainingInstances = $user->remainingInstances();
    }

    public function changePlan($uuid)
    {
        $newPlan = Plan::where('uuid', $uuid)->firstOrFail();
        return redirect()->route('payment.process', ['uuid' => $newPlan->uuid]);
    }

    public function render()
    {
        return view('livewire.client.modal.subscription-plans')->layout('layouts.main');
    }
}
