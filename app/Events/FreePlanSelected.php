<?php

namespace App\Events;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FreePlanSelected
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Plan $plan,
        public User $user,
        public string $selectedAt = null
    ) {
        $this->selectedAt = $selectedAt ?? now()->toDateTimeString();
    }
}
