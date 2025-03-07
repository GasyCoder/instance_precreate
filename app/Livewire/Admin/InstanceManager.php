<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\InstanceQuota;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class InstanceManager extends Component
{
    use LivewireAlert;

    public $url, $password, $api_key, $dbName, $dbUser, $dbPass, $instanceId, $statut = 'libre';
    public $libres, $attribues;
    
    protected $rules = [
        'url' => 'required|url|unique:instances',
        'password' => 'required|password|unique',
        'api_key' => 'requierd|api_key|unique',
        'statut' => 'required|in:libre,attribué'
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
            //Récupère les configurations de l'instance
            $this->getConfigDolibarr();

            //Insertion dans la base de donnée
            InstanceQuota::create([
                'url' => $this->url,
                'password' => $this->password,
                'api_key' => $this->api_key,
                'statut' => $this->statut,
                'db_name' => $this->dbName,
                'db_user' => $this->dbUser,
                'db_pass' => $this->dbPass,
                'instanceId' => $this->instanceId
            ]);
    
            $this->reset(['url', 'password', 'api_key', 'statut']);
            $this->updateCounts();
            $this->dispatch('instanceAdded'); // Rafraîchit la liste
        } catch(\Exception $e){
            dd($e->getMessage());
        }   
    }

    public function getConfigDolibarr()
    {
        // Spécifie le chemin du fichier de configuration Dolibarr
        $folderName = parse_url($this->url, PHP_URL_HOST);
        $filePath = '/home/sc2sylg/'. $folderName . '/conf/conf.php';

        // Vérifie si le fichier existe
        if (!file_exists($filePath)) {
            die("Fichier non trouvé !");
        }

        // Lit le contenu du fichier
        $configContent = file_get_contents($filePath);

        // Recherche les valeurs des variables avec des expressions régulières
        preg_match("/\\\$dolibarr_main_db_name\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchName);
        preg_match("/\\\$dolibarr_main_db_pass\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchPass);
        preg_match("/\\\$dolibarr_main_db_user\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchUser);
        preg_match("/\\\$dolibarr_main_instance_unique_id\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchId);

        // Récupère les valeurs trouvées (ou une valeur par défaut si non trouvée)
        $this->dbName = $matchName[1] ?? null;
        $this->dbPass = $matchPass[1] ?? null;
        $this->dbUser = $matchUser[1] ?? null;
        $this->instanceId = $matchId[1] ?? null;

        // Vérifie si toutes les valeurs ont été trouvées
        if (!$this->dbPass || !$this->dbUser || !$this->instanceId) {
            die("Une ou plusieurs valeurs manquent !");
        }
    }

    public function render()
    {
        return view('livewire.admin.instance-manager', [
            'instances' => InstanceQuota::all(),
        ]);
    }
}
