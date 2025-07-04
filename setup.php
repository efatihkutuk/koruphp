<?php
require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/config.php';
$dsn = $config['db']['dsn'];
$user = $config['db']['user'];
$pass = $config['db']['pass'];

$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

foreach (glob(__DIR__ . '/apps/*/setup.sql') as $file) {
    $sql = file_get_contents($file);
    $pdo->exec($sql);
}

echo "Database initialized at {$dsn}\n";
?>
