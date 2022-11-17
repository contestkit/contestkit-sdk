<?php

return [
    'base_url' => env('CONTESTKIT_HOST', 'https://contestkit.app/api/v1'),
    'headers' => [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ],

    'access_token' =>  env('CONTESTKIT_TOKEN'),
];
