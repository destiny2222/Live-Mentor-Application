<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'token' => [
        'key' => env('TOKEN_KEY'),
    ],

    'zoom'=>[
        'ZOOM_CLIENT_ID'=>env('ZOOM_CLIENT_ID'),
        'ZOOM_CLIENT_SECRET'=>env('ZOOM_CLIENT_SECRET'),
        'ZOOM_ACCOUNT_ID'=>env('ZOOM_ACCOUNT_ID'),
        // 'redirect_uri'=>env('ZOOM_REDIRECT_URI'),
    ],

    
    // PAYSTACK
    'paystack'=>[
        'PUBLIC_KEY'=>env('PAYSTACK_PUBLIC_KEY'),
        'SECRET_KEY'=>env('PAYSTACK_SECRET_KEY'),
        'PAYSTACK_PAYMENT_URL'=>env('PAYSTACK_PAYMENT_URL'),
        'MERCHANT_EMAIL'=>env('MERCHANT_EMAIL'),
    ],


    // google drive
    'google_drive' => [ 
        'CLIENT_ID' => env('GOOGLE_DRIVE_CLIENT_ID'),
        'CLIENT_SECRET' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
        'REFRESH_TOKEN' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
    ],

    'google' => [    
        'client_id' => env('GOOGLE_CLIENT_ID'),  
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),  
        'redirect' => env('GOOGLE_REDIRECT'),
    ],
    'facebook' => [    
        'client_id' => env('FACEBOOK_CLIENT_ID'),  
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),  
        'redirect' => env('FACEBOOK_REDIRECT_URI') 
    ],
  

];
