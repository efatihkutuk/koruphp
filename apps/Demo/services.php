<?php
use Apps\Demo\Repository\UserRepository;
use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;
use KoruPHP\Core\Container;

return function (Container $container, array $config): void {
    $container->set(UserRepository::class, function () use ($container) {
        $repo = new UserRepository($container->get('db')->getPdo());
        $repo->init();
        return $repo;
    });

    $container->set(AuthService::class, function () use ($container, $config) {
        return new AuthService($container->get(UserRepository::class), $config['google_token']);
    });

    $container->set(View::class, function () {
        return new View(__DIR__.'/View');
    });
};
