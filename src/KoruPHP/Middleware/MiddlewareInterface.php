<?php
namespace KoruPHP\Middleware;

interface MiddlewareInterface
{
    public function handle(callable $next): callable;
}
