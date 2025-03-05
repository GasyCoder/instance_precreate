<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Instance;

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
        $this->libres = Instance::where('statut', 'libre')->count();
        $this->attribues = Instance::where('statut', 'attribué')->count();
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
        return view('livewire.instance-manager', [
            'instances' => Instance::all(),
        ]);
    }
}
