<?php

return [
    'host' => env('CPANEL_HOST', 'geneve.o2switch.net'),
    'username' => env('CPANEL_USER_NAME'),
    'token' => env('CPANEL_API_TOKEN'),
    'password' => env('CPANEL_PASSWORD'),
    'cpsess' => env('CPSESS'),
    'main_domain' => env('CPANEL_MAIN_DOMAIN'),
    'document_root' => env('CPANEL_DOCUMENT_ROOT'),
];