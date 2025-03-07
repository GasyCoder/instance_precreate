<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\InstanceQuota;
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

    public function activeApi($instance_free)
    {
        try{
            config(['database.connections.dynamic' => [
                'driver' => 'mariadb',
                'host' => 'localhost',
                'database' => $instance_free->db_name,
                'username' => 'sc2sylg_001',
                'password' => 'o)7)p2SHr4',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
            ]]);
    
            $note = [
                "authorid" => "1",
                "ip" => "154.120.181.130",
                "lastactivationversion" => "dolibarr"
            ];

            DB::connection('dynamic')->table('llx2n_const')->insert([
                [
                    'name' => 'MAIN_MODULE_API',
                    'entity' => '0',
                    'value' => '1',
                    'type' => 'string',
                    'visible' => '0',
                    'note' => json_encode($note),
                    'tms' => Carbon::now()
                ],
                [
                    'name' => 'MAIN_IHM_PARAMS_REV',
                    'entity' => '1',
                    'value' => '1',
                    'type' => 'chaine',
                    'visible' => '0',
                    'note' => '',
                    'tms' => Carbon::now()
                ],
                [
                    'name' => 'MAIN_MODULE_SETUP_ON_LIST_BY_DEFAULT',
                    'entity' => '1',
                    'value' => 'commonkanban',
                    'type' => 'chaine',
                    'visible' => '0',
                    'note' => '',
                    'tms' => Carbon::now()
                ]
            ]);
        } catch(\Exception $e){
            dd($e->getMessage());
        }
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
