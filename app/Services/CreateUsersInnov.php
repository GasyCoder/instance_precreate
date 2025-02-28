<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\OtherTable;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateUsersInnov
{
    private $config;

    public function __construct()
    {
        $this->config = Config::get('dolibarr.cpanel');
    }

    public function insertIntoOtherDb($db_name, $name, $email, $api_key, $password, $urlDolibarr, $SubscriptionId){
        try{
            $subscription = Subscription::find($SubscriptionId);
            
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

            DB::connection('dynamic')->table('users')->insert([
                'name' => $name,
                'email' => $email,
                'api_key' => $api_key,
                'plan_id' => $subscription->plan_id,
                'sub_plan_id' => $subscription->sub_plan_id ?? 1,
                'status' => $subscription->status,
                'url_dolibarr' => $urlDolibarr,
                'password' => Hash::make($password) 
            ]);

            return true;
        } catch (\Exception $e){
            dd($e->getMessage());
        }
        
    }

}
