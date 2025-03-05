<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\InstanceQuota;

class InstanceManager extends Component
{
    public $nom, $url, $statut = 'libre';
    public $libres, $attribues;
    
    protected $rules = [
        'nom' => 'required|string|unique:instances',
        'url' => 'required|url|unique:instances',
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
        $this->validate();

        Instance::create([
            'nom' => $this->nom,
            'url' => $this->url,
            'statut' => $this->statut,
        ]);

        $this->reset(['nom', 'url', 'statut']);
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
