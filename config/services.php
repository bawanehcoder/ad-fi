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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID','1096727405421007'),         // Your fb Client ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET','254fbb37eb7a5c64ea5382a2c199b104'), // Your fb Client Secret
        'redirect' => env('FACEBOOK_REDIRECT','https://127.0.0.1:8000/alaa'), //must use https, if relative path given, will automatically converted to absolute url
    ],
    'instagram' => [
        'client_id' => env('INSTAGRAM_CLIENT_ID'),         // Your fb Client ID
        'client_secret' => env('INSTAGRAM_CLIENT_SECRET'), // Your fb Client Secret
        'redirect' => env('INSTAGRAM_REDIRECT_URI'), //must use https, if relative path given, will automatically converted to absolute url
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID','56040835341-5qgng7kfnlajch6t9hkl36mbtl43tl3f.apps.googleusercontent.com'),         // Your fb Client ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET','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'), // Your fb Client Secret
        'redirect' => env('GOOGLE_REDIRECT','https://zcakeshop.com/socialLogin/google/callback'), //must use https, if relative path given, will automatically converted to absolute url
    ],

    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_TOKEN', 'YOUR BOT TOKEN HERE')
    ],

    'twitter' => [
        'client_id' => getenv('TWITTER_CLIENT_ID'),
        'client_secret' => getenv('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_REDIRECT'),

        'consumer_key' => getenv('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => getenv('TWITTER_CONSUMER_SECRET'),
        'access_token' => getenv('TWITTER_ACCESS_TOKEN'),
        'access_secret' => getenv('TWITTER_ACCESS_SECRET')
    ],
    'vonage' => [
        'call_from' => env('VONAGE_CALL_FROM'),
        'call_language' => env('VONAGE_CALL_LANGUAGE', 'en-US'),
        'call_style' => env('VONAGE_CALL_STYLE', 0),
    ],
];
