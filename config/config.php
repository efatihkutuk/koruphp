<?php
require_once __DIR__ . '/../src/KoruPHP/env.php';
loadEnv(__DIR__ . '/../.env');

return [
    'env' => env('KORUPHP_ENV', 'production'),
    'debug' => env('KORUPHP_DEBUG', 'false') === 'true',
    'db' => [
        'dsn'  => env('KORUPHP_DSN', 'mysql:host=localhost;dbname=koruphp;port=3306'),
        'user' => env('KORUPHP_DB_USER', 'root'),
        'pass' => env('KORUPHP_DB_PASS', ''),
    ],
    'auth_token'      => env('KORUPHP_TOKEN', 'secret'),
    'google_client_id' => env('KORUPHP_GOOGLE_CLIENT_ID', ''),
];
