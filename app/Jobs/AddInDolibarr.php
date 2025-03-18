<?php
namespace App\Jobs;

use App\Models\InstanceQuota;
use Illuminate\Bus\Queueable;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddInDolibarr implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $contact;
    public $email;
    protected $config;

    public function __construct($email)
    {
        $this->email = $email;
        $this->config = Config::get('dolibarr.cpanel');
    }

    public function handle()
    {
        $this->getContact();
        $this->setValue();
        
        try {
            $apiData = [
                ...$this->value,
                'statut' => 1,
                'entity' => 1
            ];

            Log::info('Données envoyées à l\'API:', $apiData);
            
            $response = Http::withHeaders([
                'DOLAPIKEY' => 'V8ARU7g614rfiu5Dft2fbj4P6xXDO9TN',
                'Accept' => 'application/json'
            ])->post('https://g.erpinnov.com' . '/api/index.php/contacts', $apiData);

            if (!$response->successful()) {
                Log::error('Réponse API Dolibarr: ' . $response->body());
                throw new Exception('Erreur API: ' . $response->body());
            }

            Log::info('contact créer avec succès');
        } catch (Exception $e) {
            Log::error('Erreur création de contact: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        
    }

    public function getContact()
    {
        try {
            // Récupération des tiers depuis l'API Dolibarr
            $response = Http::withHeaders([
                'DOLAPIKEY' => 'V8ARU7g614rfiu5Dft2fbj4P6xXDO9TN' 
            ])->get('https://g.erpinnov.com' . '/api/index.php/contacts');

            if (!$response->successful()) {
                Log::info('Erreur API: ' . $response->status());
            }

            // Conversion du tableau en objets pour faciliter l'utilisation dans la vue
            $this->contact = collect($response->json())->map(function($item) {
                $item = (object) $item;

                // Récupérer le nom du pays si country_id existe
                if (!empty($item->country_id)) {
                    try {
                        $countryResponse = Http::withHeaders([
                            'DOLAPIKEY' => 'V8ARU7g614rfiu5Dft2fbj4P6xXDO9TN'
                        ])->get('https://g.erpinnov.com' . '/api/index.php/setup/dictionary/countries/' . $item->country_id);

                        if ($countryResponse->successful()) {
                            $country = $countryResponse->json();
                            $item->country = $country['label'] ?? 'N/A';
                        }
                    } catch (\Exception $e) {
                        $item->country = 'N/A';
                    }
                } else {
                    $item->country = 'N/A';
                }

                return $item;
            })->all();

            Log::info('contact récupérer avec succès ' . json_encode($this->contact));
               
        } catch (Exception $e) {
            Log::info('Erreur lors de la récupération des contacts: ' . $e->getMessage());
        }
    }

    public function setValue()
    {
        $this->value = [
            'lastname' => $this->email,
        ];    
    }
}
