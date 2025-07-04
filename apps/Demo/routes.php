<?php
use Apps\Demo\Controller\HomeController;
use Apps\Demo\Controller\AuthController;
use Apps\Demo\Controller\SessionController;
use Apps\Demo\Controller\UserController;
use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;
use KoruPHP\Auth\TokenAuthMiddleware;
use KoruPHP\Application;

return function (Application $app): void {
    $container = $app->getContainer();
    $config = $app->getConfig();
    $token = new TokenAuthMiddleware($config['auth_token']);
    $home = new HomeController($container->get(\Apps\Demo\Service\GreetingService::class), $view);
    $view = $container->get(View::class);
    $authService = $container->get(AuthService::class);
    $auth = new AuthController($authService, $view);
    $sessionController = new SessionController($container->get(\Apps\Demo\Repository\SessionRepository::class), $view);
    $userController = new UserController($container->get(\Apps\Demo\Repository\UserRepository::class), $view);

    $app->addRoute('GET', '/', [$home, 'index'], [$token]);
    $app->addRoute('GET', '/login', [$auth, 'form']);
    $app->addRoute('POST', '/login', [$auth, 'login']);
    $app->addRoute('POST', '/google-callback', [$auth, 'googleCallback']);
    $app->addRoute('GET', '/logout', [$auth, 'logout']);
    $app->addRoute('GET', '/sessions', [$sessionController, 'list'], [$token]);
    $app->addRoute('GET', '/users', [$userController, 'list'], [$token]);
    $app->addRoute('GET', '/users/create', [$userController, 'createForm'], [$token]);
    $app->addRoute('POST', '/users/create', [$userController, 'create'], [$token]);
    $app->addRoute('GET', '/users/edit', [$userController, 'editForm'], [$token]);
    $app->addRoute('POST', '/users/edit', [$userController, 'edit'], [$token]);
    $app->addRoute('GET', '/users/delete', [$userController, 'delete'], [$token]);
};
