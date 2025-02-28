<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;


class DeleteSubDomainService
{
    private $config;

    public function __construct()
    {
        $this->config = Config::get('dolibarr.cpanel');
    }

    public function deleteSubDomain($name_instance)
    {
        
        // Informations d'accès cPanel (à récupérer du fichier .env par exemple)
        $cpanel_user = $this->config['user'];
        $cpanel_pass = $this->config['password'];
        $cpanel_host = $this->config['host'];
        $cpanel_main_domain = $this->config['main_domain'];
        
        $subdomain = $name_instance;
        $domain = $cpanel_main_domain; 
        
        // API pour supprimer le sous-domaine (cPanel API 2)
        $delete_subdomain_url = "https://{$cpanel_user}:{$cpanel_pass}@{$cpanel_host}:2083/json-api/cpanel?cpanel_jsonapi_user={$cpanel_user}&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=delsubdomain&domain={$subdomain}_{$domain}";
        
        // Envoyer la requête pour supprimer le sous-domaine
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $delete_subdomain_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $delete_subdomain_response = curl_exec($ch);
        curl_close($ch);
        
        return true;
        
    }
}
