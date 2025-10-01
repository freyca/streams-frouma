<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Allows user to register in the application
    |--------------------------------------------------------------------------
    */

    'register_enabled' => env('APP_REGISTER_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Allows user to login in the application
    |--------------------------------------------------------------------------
    */
    'login_enabled' => env('APP_LOGIN_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Brand image, it will be shown on upper part of website in brand-copy view
    |--------------------------------------------------------------------------
    */
    'brand_image' => env('BRAND_IMAGE', '/images/logo_frouma.jpeg'),

];
