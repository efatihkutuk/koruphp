<?php
use KoruPHP\Application;
use KoruPHP\Database\Connection;
use KoruPHP\Middleware\DebugMiddleware;
use KoruPHP\Middleware\SessionMiddleware;
use KoruPHP\Session\DbSessionHandler;

$config = require __DIR__.'/../../config/config.php';

$app = new Application($config);
$container = $app->getContainer();
$container->set('db', function () use ($config) {
    $db = $config['db'];
    return new Connection($db['dsn'], $db['user'], $db['pass']);
});

$handler = new DbSessionHandler($container->get('db')->getPdo());
session_set_save_handler($handler, true);

foreach (glob(__DIR__.'/../../apps/*/services.php') as $serviceFile) {
    $register = require $serviceFile;
    $register($container, $config);
}

$app->addMiddleware(new DebugMiddleware($config['debug']));
$app->addMiddleware(new SessionMiddleware());

return $app;
