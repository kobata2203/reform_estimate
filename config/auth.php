<?php

return [
    'defaults' => [
        'guard' => 'sales',
        'passwords' => 'users',
    ],
    'guards' => [
        'sales' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],
    'names' => [
        'saler' => env('AUTH_NAME_USER', '営業者'),
        'admin' => env('AUTH_NAME_ADMIN', '管理者'),
    ],

];
