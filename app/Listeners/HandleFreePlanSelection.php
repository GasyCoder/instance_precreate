<?php

namespace App\Listeners;

use App\Events\FreePlanSelected;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFreePlanSelection implements ShouldQueue
{
    public function handle(FreePlanSelected $event)
    {
        // Logique supplémentaire après la sélection d'un plan gratuit
        // Par exemple : envoi d'email, création de statistiques, etc.
        logger()->info('Plan gratuit sélectionné', [
            'user_id' => $event->user->id,
            'plan_id' => $event->plan->id,
            'selected_at' => $event->selectedAt
        ]);
    }
}
