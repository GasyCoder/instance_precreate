<?php

namespace App\Events;

use App\Models\Instance;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InstanceCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $instance;

    public function __construct(Instance $instance)
    {
        $this->instance = $instance;
    }
}
