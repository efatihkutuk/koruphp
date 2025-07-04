<?php
use Apps\Demo\Repository\UserRepository;
use Apps\Demo\Repository\SessionRepository;
use Apps\Demo\Service\AuthService;
use Apps\Demo\Service\GreetingService;
use KoruPHP\View\TwigView;
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

    $container->set(GreetingService::class, function () {
        return new GreetingService();
    });

    $container->set(TwigView::class, function () {
        return new TwigView(__DIR__.'/templates');
    });
    // also register under View::class for convenience
    $container->set(KoruPHP\View\View::class, function () use ($container) {
        return $container->get(TwigView::class);
    });
};
