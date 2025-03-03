<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

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
            $document_root = '/home7/sc1sylg/sante.gasikara.mg';

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
            $url = "https://$cpanel_host:2083/" . $cpsess . "/execute/DNS/add_zone_record?domain=gasikara.mg&type=A&name=$subDomain&address=109.234.160.27";

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
            dd($e->getMEssage());
        }
        

        

        
        
    }

}
