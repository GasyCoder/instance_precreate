<?php

namespace App\Providers;

use App\Events\FreePlanSelected;
use App\Listeners\HandleFreePlanSelection;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FreePlanSelected::class => [
            HandleFreePlanSelection::class,
        ],
    ];
}
