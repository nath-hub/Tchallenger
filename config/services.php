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
        'client_id' => '867540551656344', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => 'd1782b234b656de5c6f9f053ed6fce14', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://www.backend.tchallenger.com/public/facebook/callback'
    ],

    'google' => [
        'client_id' => '359803378024-vo14cl4euq150hsngg545lt56qciu0r4.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://www.backend.tchallenger.com/public/callback/google',
      ], 

];
