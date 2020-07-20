<?php


return [
    
    /*
    |--------------------------------------------------------------------------
    |   Your Nedo domain
    |--------------------------------------------------------------------------
    |   As set in the administration page
    |
    */
    'domain'        => env( 'NEDO_DOMAIN' ),
    
    /*
    |--------------------------------------------------------------------------
    |   Your Nedo user type
    |--------------------------------------------------------------------------
    |   As set in the administration page
    |
    */
    'user_type'        => env( 'NEDO_USER_TYPE' ),
    
    /*
    |--------------------------------------------------------------------------
    |   Your Nedo APP id
    |--------------------------------------------------------------------------
    |   As set in the service code / service user to access Nedo server
    |
    */
    'service_code'     => env( 'NEDO_SERVICE_CODE' ),
    /*
    |--------------------------------------------------------------------------
    |   Your Nedo APP secret
    |--------------------------------------------------------------------------
    |   As set in the Nedo administration page
    |
    */
    'service_secret' => env( 'NEDO_SERVICE_SECRET' ),
    /*
     |--------------------------------------------------------------------------
     |   The redirect URI
     |--------------------------------------------------------------------------
     |   Should be the same that the one configure in the route to handle the
     |
     */
    'redirect_uri'  => env( 'APP_URL' ) . '/nedo/callback',
    /*
    |--------------------------------------------------------------------------
    |   Persistence Configuration
    |--------------------------------------------------------------------------
    |   persist_user            (Boolean) Optional. Indicates if you want to persist the user info, default true
    |   persist_access_token    (Boolean) Optional. Indicates if you want to persist the access token, default false
    |   persist_refresh_token   (Boolean) Optional. Indicates if you want to persist the refresh token, default false
    |   persist_id_token        (Boolean) Optional. Indicates if you want to persist the id token, default false
    |
    */
    'persist_user' => true,
    'persist_access_token' => false,
    'persist_refresh_token' => false,
    'persist_id_token' => false,
    /*
    |--------------------------------------------------------------------------
    |   The authorized token issuers
    |--------------------------------------------------------------------------
    |   This is used to verify the decoded tokens when using RS256
    |
    */
    'authorized_issuers'  => [ env( 'NEDO_DOMAIN' ) ],
    /*
    |--------------------------------------------------------------------------
    |   The authorized token audiences
    |--------------------------------------------------------------------------
    |
    */
    // 'api_identifier'  => '',
    /*
    |--------------------------------------------------------------------------
    |   The secret format
    |--------------------------------------------------------------------------
    |   Used to know if it should decode the secret when using HS256
    |
    */
    'secret_base64_encoded'  => false,
    /*
    |--------------------------------------------------------------------------
    |   Supported algorithms
    |--------------------------------------------------------------------------
    |   Token decoding algorithms supported by your API
    |
    */
    'supported_algs'        => [ 'RS256' ],
];