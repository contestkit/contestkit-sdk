<?php

return [
    'base_url' => env('CONTESTKIT_APi_URL', 'https://contestkit.app/api/v1'),
    'headers' => [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ],

    'access_token' =>  env('CONTESTKIT_API_TOKEN'),
];
