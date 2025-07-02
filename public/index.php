<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../src/KoruPHP/bootstrap.php';

foreach (glob(__DIR__ . '/../apps/*/routes.php') as $routesFile) {
    $register = require $routesFile;
    $register($app);
}

$app->run();
