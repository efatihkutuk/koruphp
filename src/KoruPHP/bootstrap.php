<?php
use KoruPHP\Application;
use KoruPHP\Database\Connection;
use KoruPHP\Middleware\DebugMiddleware;
use KoruPHP\Middleware\SessionMiddleware;
use Apps\Demo\Repository\UserRepository;
use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;

$config = require __DIR__.'/../../config/config.php';

$app = new Application($config);

$container = $app->getContainer();
$container->set('db', function () use ($config) {
    $db = $config['db'];
    return new Connection($db['dsn'], $db['user'], $db['pass']);
});
$container->set(UserRepository::class, function () use ($container) {
    $repo = new UserRepository($container->get('db')->getPdo());
    $repo->init();
    return $repo;
});
$container->set(AuthService::class, function () use ($container, $config) {
    return new AuthService($container->get(UserRepository::class), $config['google_token']);
});
$container->set(View::class, function () {
    return new View(__DIR__.'/../../apps/Demo/View');
});

$app->addMiddleware(new DebugMiddleware($config['debug']));
$app->addMiddleware(new SessionMiddleware());

return $app;
