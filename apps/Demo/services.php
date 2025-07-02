<?php
use Apps\Demo\Repository\UserRepository;
use Apps\Demo\Repository\SessionRepository;
use Apps\Demo\Service\AuthService;
use KoruPHP\View\View;
use KoruPHP\Core\Container;

return function (Container $container, array $config): void {
    $container->set(UserRepository::class, function () use ($container) {
        $repo = new UserRepository($container->get('db')->getPdo());
        $repo->init();
        return $repo;
    });

    $container->set(SessionRepository::class, function () use ($container) {
        return new SessionRepository($container->get('db')->getPdo());
    });

    $container->set(AuthService::class, function () use ($container, $config) {
        return new AuthService(
            $container->get(UserRepository::class),
            $config['google_client_id']
        );
    });

    $container->set(View::class, function () {
        return new View(__DIR__.'/View');
    });
};
