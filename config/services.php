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
        'client_id' => '695898041780954',  //client face của bạn
        'client_secret' => 'ea85124966ac5534e43248a5fd01e224',  //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhang/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '741463141595-eo8posj6c6cohpll81qqdr81j3k0jptp.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/shopbanhang/google/callback',
    ],



];
