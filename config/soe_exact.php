<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | The Client ID provided to you by Software of Excellence.
    |
    */

    'client_id' => env('SOE_EXACT_CLIENT_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Client Secret
    |--------------------------------------------------------------------------
    |
    | The Client Secret provided to you by Software of Excellence.
    |
    */

    'client_secret' => env('SOE_EXACT_CLIENT_SECRET', ''),    

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | The environment to use (either qa or production).
    |
    */

    'environment' => env('SOE_EXACT_ENVIRONMENT', 'qa'), 

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | The OAuth scopes applicable on boot. These can be changed at runtime.
    | Comma separated values
    |
    */

    'scopes' => env('SOE_EXACT_SCOPES', 'productsubscription.get'), 
];
