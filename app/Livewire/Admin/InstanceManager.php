<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\InstanceQuota;

class InstanceManager extends Component
{
    public $url, $password, $api_key, $statut = 'libre';
    public $libres, $attribues;
    
    protected $rules = [
        'url' => 'required|url|unique:instances',
        'password' => 'required|password|unique',
        'api_key' => 'requierd|api_key|unique',
        'statut' => 'required|in:libre,attribué',
    ];

    public function mount()
    {
        $this->updateCounts();
    }

    public function updateCounts()
    {
        $this->libres = InstanceQuota::where('statut', 'libre')->count();
        $this->attribues = InstanceQuota::where('statut', 'attribué')->count();
    }

    public function addInstance()
    {

        InstanceQuota::create([
            'url' => $this->url,
            'password' => $this->password,
            'api_key' => $this->api_key,
            'statut' => $this->statut,
        ]);

        $this->reset(['url', 'password', 'api_key', 'statut']);
        $this->updateCounts();
        $this->emit('instanceAdded'); // Rafraîchit la liste
    }

    public function render()
    {
        return view('livewire.admin.instance-manager', [
            'instances' => InstanceQuota::all(),
        ]);
    }
}
