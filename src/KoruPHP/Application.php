<?php
namespace KoruPHP;

class Application
{
    protected array $routes = [];

    public function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[] = [$method, $path, $handler];
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');

        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            if ($method === $routeMethod && $routePath === $uri) {
                echo $handler();
                return;
            }
        }

        http_response_code(404);
        echo 'Not Found';
    }
}
