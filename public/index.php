<?php
require_once __DIR__ . '/../vendor/autoload.php';

use KoruPHP\Application;
use KoruPHP\Controller\HelloController;

$app = new Application();

$controller = new HelloController();
$app->addRoute('GET', '/', [$controller, 'index']);

$app->run();
