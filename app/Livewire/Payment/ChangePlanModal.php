<?php
// app/Http/Livewire/ChangePlanModal.php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\Plan;

class ChangePlanModal extends Component
{
    public $plans;
    public $selectedPlan;

    public function mount()
    {
        $this->plans = Plan::all();
    }

    public function selectPlan($planId)
    {
        $this->selectedPlan = Plan::find($planId);
        $this->emit('planChanged', $this->selectedPlan);
    }

    public function render()
    {
        return view('livewire.client.modal.change-plan-modal');
    }
}
