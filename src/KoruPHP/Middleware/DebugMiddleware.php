<?php
namespace KoruPHP\Middleware;

class DebugMiddleware implements MiddlewareInterface
{
    public function __construct(private bool $debug)
    {
    }

    public function handle(callable $next): callable
    {
        return function () use ($next) {
            if ($this->debug) {
                ini_set('display_errors', '1');
                error_reporting(E_ALL);
            } else {
                ini_set('display_errors', '0');
            }
            return $next();
        };
    }
}
