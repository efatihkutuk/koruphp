<?php
namespace KoruPHP;

use KoruPHP\Core\Container;
use KoruPHP\Middleware\MiddlewareInterface;

class Application
{
    private array $routes = [];
    private array $middlewares = [];
    private Container $container;
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->container = new Container();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function addRoute(string $method, string $path, callable $handler, array $middlewares = []): void
    {
        $this->routes[] = [$method, $path, $handler, $middlewares];
    }

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');

        foreach ($this->routes as [$routeMethod, $routePath, $handler, $routeMiddleware]) {
            if ($method === $routeMethod && $routePath === $uri) {
                $pipeline = array_merge($this->middlewares, $routeMiddleware);
                $callable = fn() => call_user_func($handler, $this->container);
                while ($middleware = array_pop($pipeline)) {
                    $callable = $middleware->handle($callable);
                }
                echo $callable();
                return;
            }
        }

        http_response_code(404);
        echo 'Not Found';
    }
}
