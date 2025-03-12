<?php
namespace App\Jobs;

use App\Models\InstanceQuota;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReplaceFreeSubdomain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $config;

    public function __construct()
    {
        $this->config = Config::get('dolibarr.cpanel');
    }

    public function handle()
    {
        try {
            // Récupère le dernier enregistrement
            $lastInstance = InstanceQuota::all()->last();
            
            if ($lastInstance) {
                // Récupère l'URL et extrait le sous-domaine
                $lastInstanceUrl = $lastInstance->url;
                $host = parse_url($lastInstanceUrl, PHP_URL_HOST);
                $lastSuffixSubDomain = explode('.', $host)[0];

                // Génère le prochain sous-domaine
                $newSuffixSubDomain = sprintf("%03d", $lastSuffixSubDomain + 1);
            } else {
                // Si aucune instance, commence par "001"
                $newSuffixSubDomain = "001";
            }

            // Configuration cPanel
            $cpanel_host = $this->config['host'];
            $cpanel_user = $this->config['user'];
            $api_token = $this->config['token'];
            $main_domain = $this->config['main_domain'];
            $document_root = $this->config['document_root'] . $newSuffixSubDomain . "." . $main_domain;
            $cpsess = $this->config['cpsess'];

            // URL de l'API cPanel pour ajouter un sous-domaine
            $url = "https://$cpanel_host:2083/$cpsess/execute/SubDomain/addsubdomain?domain=$newSuffixSubDomain&rootdomain=$main_domain&dir=$document_root";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: cpanel $cpanel_user:$api_token"
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                Log::error('Erreur cURL (Ajout Sous-Domaine) : ' . curl_error($ch));
                return false;
            }
            curl_close($ch);

            // Ajout du record DNS
            $subDomain = $newSuffixSubDomain . "." . $main_domain;
            $url = "https://$cpanel_host:2083/$cpsess/execute/DNS/add_zone_record?domain=$main_domain&type=A&name=$subDomain&address=109.234.160.27";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $cpanel_user . ":" . $this->config['password']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                Log::error('Erreur cURL (Ajout DNS) : ' . curl_error($ch));
                return false;
            }
            curl_close($ch);
            
            Log::info("Sous-domaine créé avec succès : $subDomain");

        } catch (\Exception $e) {
            Log::error("Erreur lors de la création du sous-domaine : " . $e->getMessage());
        }
    }
}
