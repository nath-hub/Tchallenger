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
        'client_id' => '297695824536822', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '55490def2f1b7a36172d4b63a4393a55', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://www.backend.tchallenger.com/public/api/facebook/callback'
    ],

    // 'google' => [
    //     'client_id' => '359803378024-kgh1datd8j0q3glb4cj7ihbr3g0har3c.apps.googleusercontent.com',
    //     'client_secret' => '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',
    //     'redirect' => 'http://127.0.0.1:8000/api/callback/google',
    //   ], 

      'google' => [
        'client_id' => '359803378024-ai9mu41fh96kjksgac7v1audmok6o144.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://www.backend.tchallenger.com/public/api/callback/google',
      ], 

      'twitter' => [
        'client_id' => 'WUU1bzVxc2xFT2h2bnZncFAxYm06MTpjaQ',
        'client_secret' => 'ydCJTXjUom-CwF3usNke7d2vXR9Gc7PN0QT4hbbE8YlNdiC6iH',
        'redirect' => 'https://www.backend.tchallenger.com/public/api/callback/twitter',
      ], 

];
