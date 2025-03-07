<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\InstanceQuota;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class InstanceManager extends Component
{
    use LivewireAlert;

    public $url, $password, $api_key, $db_name, $statut = 'libre';
    public $libres, $attribues;
    
    protected $rules = [
        'url' => 'required|url|unique:instances',
        'password' => 'required|password|unique',
        'api_key' => 'requierd|api_key|unique',
        'statut' => 'required|in:libre,attribué',
        'db_name' => 'required|in:db_name|unique'
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
        try{
            InstanceQuota::create([
                'url' => $this->url,
                'password' => $this->password,
                'api_key' => $this->api_key,
                'statut' => $this->statut,
            ]);
    
            $this->reset(['url', 'password', 'api_key', 'statut']);
            $this->updateCounts();
            $this->dispatch('instanceAdded'); // Rafraîchit la liste
        } catch(\Exception $e){
            $this->alert('error', 'Erreur lors de l\'ajout de l\'instance: ' . $e->getMessage());
        }
        
    }

    public function render()
    {
        return view('livewire.admin.instance-manager', [
            'instances' => InstanceQuota::all(),
        ]);
    }
}
