<?php
namespace KoruPHP\Middleware;

class SessionMiddleware implements MiddlewareInterface
{
    public function handle(callable $next): callable
    {
        return function () use ($next) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            return $next();
        };
    }
}
