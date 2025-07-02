<?php
use KoruPHP\Application;
use KoruPHP\Database\Connection;
use KoruPHP\Auth\TokenAuthMiddleware;
use KoruPHP\Middleware\DebugMiddleware;

$config = require __DIR__.'/../../config/config.php';

$app = new Application($config);

$container = $app->getContainer();
$container->set('db', function () use ($config) {
    $db = $config['db'];
    return new Connection($db['dsn'], $db['user'], $db['pass']);
});

$app->addMiddleware(new DebugMiddleware($config['debug']));
$app->addMiddleware(new TokenAuthMiddleware($config['auth_token']));

return $app;
