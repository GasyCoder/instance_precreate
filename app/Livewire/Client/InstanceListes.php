<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Instance;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InstanceListes extends Component
{
    use WithPagination, LivewireAlert, AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    public $page = 4;
    public $isLoading = true;
    public $showPlanSelection = false;

    public $instanceId;
    public $name, $reference, $created_at, $expiration_date, $status, $planType, $dolibarr_username, $url, $modules;


    public function delete($instanceId)
    {
        $instance = Instance::findOrFail($instanceId);
        $this->authorize('delete', $instance);
        $instance->delete();
        $this->alert('success', 'Instance supprimée avec succès.');
    }

    public function render()
    {
        $user = Auth::user();
        return view('livewire.client.sections.instance-listes', [
            'showPlanSelection' => $this->showPlanSelection,
            'instances' => Instance::where('user_id', $user->id)
                ->with('subscription.plan')
                ->latest()
                ->simplePaginate($this->page),
        ])->layout('layouts.main');
    }
}
