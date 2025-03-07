<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\InstanceQuota;
use Illuminate\Support\Facades\DB;
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
        /*try{
            InstanceQuota::create([
                'url' => $this->url,
                'password' => $this->password,
                'api_key' => $this->api_key,
                'statut' => $this->statut,
                'db_name' => $this->db_name
            ]);
    
            $this->reset(['url', 'password', 'api_key', 'statut', 'db_name']);
            $this->updateCounts();
            $this->dispatch('instanceAdded'); // Rafraîchit la liste
        } catch(\Exception $e){
            dd($e->getMessage());
        }*/

        $this->getConfigDolibarr();
        
    }

    public function getConfigDolibarr()
    {
        // Spécifie le chemin du fichier de configuration Dolibarr
        $folderName = parse_url($url, PHP_URL_HOST);
        $filePath = '/home/sc2sylg/'. $folderName . '/conf/conf.php';

        // Vérifie si le fichier existe
        if (!file_exists($filePath)) {
            die("Fichier non trouvé !");
        }

        // Lit le contenu du fichier
        $configContent = file_get_contents($filePath);

        // Recherche les valeurs des variables avec des expressions régulières
        preg_match("/\\$dolibarr_main_db_pass\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchPass);
        preg_match("/\\$dolibarr_main_db_user\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchUser);
        preg_match("/\\$dolibarr_main_instance_unique_id\\s*=\\s*['\"](.*?)['\"];/", $configContent, $matchId);

        // Récupère les valeurs trouvées (ou une valeur par défaut si non trouvée)
        $dbPass = $matchPass[1] ?? null;
        $dbUser = $matchUser[1] ?? null;
        $instanceId = $matchId[1] ?? null;

        // Vérifie si toutes les valeurs ont été trouvées
        if (!$dbPass || !$dbUser || !$instanceId) {
            die("Une ou plusieurs valeurs manquent !");
        }

        dd($db_user . db_pass . $instanceId);
        // Insère dans la base de données Laravel
        /*DB::table('ton_table')->insert([
            'db_user' => $dbUser,
            'db_pass' => $dbPass,
            'instance_id' => $instanceId,
            'created_at' => now(),
        ]);*/

        echo "Données insérées avec succès !";

    }

    public function render()
    {
        return view('livewire.admin.instance-manager', [
            'instances' => InstanceQuota::all(),
        ]);
    }
}
