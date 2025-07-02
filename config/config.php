<?php
return [
    'env' => getenv('KORUPHP_ENV') ?: 'production',
    'debug' => getenv('KORUPHP_DEBUG') === 'true',
    'db' => [
        'dsn' => getenv('KORUPHP_DSN') ?: 'sqlite::memory:',
        'user' => getenv('KORUPHP_DB_USER') ?: '',
        'pass' => getenv('KORUPHP_DB_PASS') ?: '',
    ],
    'auth_token' => getenv('KORUPHP_TOKEN') ?: 'secret',
    'google_token' => getenv('KORUPHP_GOOGLE_TOKEN') ?: 'test-google-token',
];
