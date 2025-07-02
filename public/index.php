<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Apps\Demo\Controller\HomeController;

$app = require __DIR__ . '/../src/KoruPHP/bootstrap.php';

$home = new HomeController();
$app->addRoute('GET', '/', [$home, 'index']);

$app->run();
