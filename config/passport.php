<?php

// config/passport.php
return [
    'defaults' => [
        'guard' => 'api',
        'password_grant_client_id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
        'password_grant_client_secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
        'personal_access_client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'personal_access_client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
        'refresh_token_lifetime' => env('PASSPORT_REFRESH_TOKEN_LIFETIME', 30),
    ],

    'password_client' => [
        'client_id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
        'redirect' => env('PASSPORT_PASSWORD_GRANT_REDIRECT'),
    ],

    'personal_access_client' => [
        'client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
    ],

    'oauth_clients' => [
        [
            'id' => env('PASSPORT_CLIENT_ID'),
            'secret' => env('PASSPORT_CLIENT_SECRET'),
            'name' => env('APP_NAME') . ' Password Grant Client',
            'redirect' => env('PASSPORT_CLIENT_REDIRECT'),
            'provider' => 'users',
            'personal_access_client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
            'personal_access_client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
        ],
    ],

    'tokens' => [
        'access_token_lifetime' => env('PASSPORT_ACCESS_TOKEN_LIFETIME', 60),
        'refresh_token_lifetime' => env('PASSPORT_REFRESH_TOKEN_LIFETIME', 1440),
    ],
];
