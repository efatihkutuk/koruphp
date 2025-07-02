<?php
require_once __DIR__ . '/../src/KoruPHP/env.php';
loadEnv(__DIR__ . '/../.env');

return [
    'env' => env('KORUPHP_ENV', 'production'),
    'debug' => env('KORUPHP_DEBUG', 'false') === 'true',
    'db' => [
        'dsn' => env('KORUPHP_DSN', 'sqlite:' . __DIR__ . '/../data/app.sqlite'),
        'user' => env('KORUPHP_DB_USER', ''),
        'pass' => env('KORUPHP_DB_PASS', ''),
    ],
    'auth_token' => env('KORUPHP_TOKEN', 'secret'),
    'google_token' => env('KORUPHP_GOOGLE_TOKEN', 'test-google-token'),
];
