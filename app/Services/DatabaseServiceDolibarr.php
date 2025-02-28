<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class DatabaseServiceDolibarr
{
    private $config;

    public function __construct()
    {
        $this->config = Config::get('dolibarr.cpanel');
    }
    
    public function updateCredentials($db_name, $api_key)
    {
        try {
            config(['database.connections.dynamic' => [
                'driver' => 'mariadb',
                'host' => 'localhost',
                'database' => $db_name,
                'username' => $this->config['mysql_user'],
                'password' => $this->config['mysql_password'],
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
            ]]);
    
            DB::purge('dynamic');
            DB::reconnect('dynamic');
    
            // Crypter le mot de passe selon la méthode utilisée par Dolibarr
            $passwordCrypted = $this->cryptDolibarrPassword($password);
            
            
            DB::connection('dynamic')->table('llx2n_user')
                ->where('rowid', 1)
                ->update([
                    'api_key' => $api_key
                ]);
    
            return true;
        } catch (\Exception $e) {
            \Log::error("Erreur lors de la mise à jour : " . $e->getMessage());
            return false;
        }
    }
    
    private function cryptDolibarrPassword($password)
    {
        // Implémentez ici la méthode de cryptage utilisée par Dolibarr
        // Par exemple, si Dolibarr utilise password_hash :
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
