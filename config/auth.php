<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuarios',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'usuarios',
            'hash' => false,
        ],
    ],

    'providers' => [
        'usuarios' => [
            'driver' => 'database',
            'table' => 'usuario',
        ],
    ],

    'passwords' => [
        'usuarios' => [
            'provider' => 'usuarios',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
