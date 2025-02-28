<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class EncryptApiService
{
    public function dolEncryptApi($chain, $key = '', $ciphering = 'AES-256-CTR')
    {
        if ($chain === '' || is_null($chain)) {
            return '';
        }
    
        if (preg_match('/^dolcrypt:([^:]+):(.+)$/', $chain)) {
            return $chain;
        }
    
        if (empty($key)) {
            return $chain;
        }
    
        // Important : On utilise directement la valeur '10fbb3f05469219f' comme IV
        $ivseed = '10fbb3f05469219f';
    
        if (function_exists('openssl_encrypt')) {
            $encrypted = openssl_encrypt($chain, $ciphering, $key, 0, $ivseed);
            return 'dolcrypt:' . $ciphering . ':' . $ivseed . ':' . $encrypted;
        }
    
        return $chain;
        }
}