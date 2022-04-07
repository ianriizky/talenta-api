<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | Set the base URL used on the Talenta API.
    |
    */

    'base_url' => env('TALENTA_BASE_URL'),

    /*
    |--------------------------------------------------------------------------
    | SSL Certificate Verification
    |--------------------------------------------------------------------------
    |
    | Determine the configuration of SSL certificate verification from guzzlehttp/guzzle.
    |
    | Note: If your Laravel application environment is in "local" state, then this
    |       configuration value will be automatically set as "false".
    |
    | @see https://docs.guzzlephp.org/en/stable/request-options.html#verify
    |
    */

    'ssl_verify' => env('TALENTA_SSL_VERIFY'),

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | HMAC username and secret for the authentication purpose when login into Talenta API.
    |
    */

    'hmac_username' => env('TALENTA_HMAC_USERNAME'),

    'hmac_secret' => env('TALENTA_HMAC_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Laravel HTTP Client Configuration
    |--------------------------------------------------------------------------
    |
    | Here is the list of value that will be used on the Laravel HTTP Client Configuration.
    |
    */

    'request_retry_times' => env('TALENTA_REQUEST_RETRY_TIMES', 2),

    'request_retry_sleep' => env('TALENTA_REQUEST_RETRY_SLEEP', 0),

    /*
    |--------------------------------------------------------------------------
    | Guzzle Request Configuration
    |--------------------------------------------------------------------------
    |
    | Here is the list of value that will be used on the Guzzle Request Configuration.
    |
    | @see https://docs.guzzlephp.org/en/stable/request-options.html
    |
    */

    'guzzle_options' => [],
];
