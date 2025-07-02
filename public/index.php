<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Apps\Demo\Controller\HomeController;
use Apps\Demo\Controller\AuthController;
use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;
use KoruPHP\Auth\TokenAuthMiddleware;

$app = require __DIR__ . '/../src/KoruPHP/bootstrap.php';
$config = $app->getConfig();

$token = new TokenAuthMiddleware($config['auth_token']);
$home = new HomeController();
$view = $app->getContainer()->get(View::class);
$authService = $app->getContainer()->get(AuthService::class);
$auth = new AuthController($authService, $view);

$app->addRoute('GET', '/', [$home, 'index'], [$token]);
$app->addRoute('GET', '/login', [$auth, 'form']);
$app->addRoute('POST', '/login', [$auth, 'login']);
$app->addRoute('GET', '/google-login', [$auth, 'google']);

$app->run();
