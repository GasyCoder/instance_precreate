<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use App\Models\InstanceQuota;

class CpanelService
{
    private $config;

    public function __construct()
    {
        $this->config = Config::get('dolibarr.cpanel');
    }
    
    public function createSubdomainInnov($suffixSubDomain)
    {
        try{
            $cpanel_host = $this->config['host'];
            $cpanel_user = $this->config['user'];
            $api_token = $this->config['token'];
            $main_domain = $this->config['main_domain'];
            $document_root = '/home/sc2sylg/instance.erpinnov.com';

            $cpsess = $this->config['cpsess'];

            $url = "https://$cpanel_host:2083/" . $cpsess . "/execute/SubDomain/addsubdomain?domain=$suffixSubDomain&rootdomain=$main_domain&dir=$document_root";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: cpanel $cpanel_user:$api_token"
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                \Log::error('Erreur cURL : ' . curl_error($ch));
                return false;
            }
            curl_close($ch);

            $subDomain = $suffixSubDomain . "." . $main_domain;
            $url = "https://$cpanel_host:2083/" . $cpsess . "/execute/DNS/add_zone_record?domain=erpinnov.com&type=A&name=$subDomain&address=109.234.160.27";

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $cpanel_user . ":" . $this->config['password']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                \Log::error('Erreur cURL : ' . curl_error($ch));
                return false;
            }
            curl_close($ch);
            
            return true;
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function createSubdomainDolibarr()
    {
        try{
            //Récupère la dernière enregistrement
            $lastInstance = InstanceQuota::all()->last();

            if($lastInstance)
            {
                //Récupère l'url de l'enregistrement
                $lastInstanceUrl = $lastInstance->url;;

                // Extraire le host (006.erpinnov.com)
                $host = parse_url($lastInstanceUrl, PHP_URL_HOST);

                $lastSuffixSubDomain = explode('.', $host)[0];

                //Nouvelle numéro de sous-domaine
                $newSuffixSubDomain = sprintf("%03d", $lastSuffixSubDomain + 1);
            }

            $cpanel_host = $this->config['host'];
            $cpanel_user = $this->config['user'];
            $api_token = $this->config['token'];
            $main_domain = $this->config['main_domain'];
            $document_root = $this->config['document_root'] . $newSuffixSubDomain . "." . $main_domain;

            $cpsess = $this->config['cpsess'];

            $url = "https://$cpanel_host:2083/" . $cpsess . "/execute/SubDomain/addsubdomain?domain=$newSuffixSubDomain&rootdomain=$main_domain&dir=$document_root";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: cpanel $cpanel_user:$api_token"
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                \Log::error('Erreur cURL : ' . curl_error($ch));
                return false;
            }
            curl_close($ch);

            $subDomain = $newSuffixSubDomain . "." . $main_domain;
            $url = "https://$cpanel_host:2083/" . $cpsess . "/execute/DNS/add_zone_record?domain=erpinnov.com&type=A&name=$subDomain&address=109.234.160.27";

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $cpanel_user . ":" . $this->config['password']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                \Log::error('Erreur cURL : ' . curl_error($ch));
                return false;
            }
            curl_close($ch);
            
            dd('sous-domaine créer');
            return true;
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }

}
