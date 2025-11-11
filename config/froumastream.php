<?php

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
    | Allows the application to track users watching the streaming
    |--------------------------------------------------------------------------
    */
    'tracks_viewers' => env('APP_TRACKS_VIEWERS', true),

    /*
    |--------------------------------------------------------------------------
    | Allows user to login in the application
    |--------------------------------------------------------------------------
    */
    'has_chat' => env('APP_HAS_CHAT', true),

    /*
    |--------------------------------------------------------------------------
    | Brand image, it will be shown on upper part of website in brand-copy view
    |--------------------------------------------------------------------------
    */
    'brand_image' => env('BRAND_IMAGE', '/images/logo_frouma.jpeg'),

    /*
    |--------------------------------------------------------------------------
    | Playback URL, the videojs stream
    |--------------------------------------------------------------------------
    */
    'videojs_playback_url' => env('VIDEOJS_PLAYBACK_URL'),

];
