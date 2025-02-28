<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class DeleteDatabaseService{
    
    private $config;

    public function __construct()
    {
        $this->config = Config::get('dolibarr.cpanel');
    }

    public function deleteDatabase($databaseName)
    {
        
         // Informations d'accès cPanel (à récupérer du fichier .env par exemple)
        $cpanel_user = $this->config['user'];
        $cpanel_pass = $this->config['password'];
        $cpanel_host = $this->config['host'];
        $auth_token = $this->config['token'];
        $database_name = "sc2sylg_".$databaseName;
        
    
        
           $api_url = "https://$cpanel_host:2083/execute/Mysql/delete_database?name=$database_name";

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: cpanel $cpanel_user:$auth_token"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return true;
       
    }
}
