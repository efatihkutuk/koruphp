<?php
use Apps\Demo\Controller\HomeController;
use Apps\Demo\Controller\AuthController;
use Apps\Demo\Controller\SessionController;
use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;
use KoruPHP\Auth\TokenAuthMiddleware;
use KoruPHP\Application;

return function (Application $app): void {
    $container = $app->getContainer();
    $config = $app->getConfig();
    $token = new TokenAuthMiddleware($config['auth_token']);
    $home = new HomeController();
    $view = $container->get(View::class);
    $authService = $container->get(AuthService::class);
    $auth = new AuthController($authService, $view);
    $sessionController = new SessionController($container->get(\Apps\Demo\Repository\SessionRepository::class), $view);

    $app->addRoute('GET', '/', [$home, 'index'], [$token]);
    $app->addRoute('GET', '/login', [$auth, 'form']);
    $app->addRoute('POST', '/login', [$auth, 'login']);
    $app->addRoute('POST', '/google-callback', [$auth, 'googleCallback']);
    $app->addRoute('GET', '/logout', [$auth, 'logout']);
    $app->addRoute('GET', '/sessions', [$sessionController, 'list'], [$token]);
};
