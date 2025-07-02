<?php
namespace KoruPHP\Auth;

use KoruPHP\Middleware\MiddlewareInterface;

class TokenAuthMiddleware implements MiddlewareInterface
{
    public function __construct(private string $token)
    {
    }

    public function handle(callable $next): callable
    {
        return function () use ($next) {
            $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            if ($header !== 'Bearer ' . $this->token) {
                http_response_code(401);
                return 'Unauthorized';
            }
            return $next();
        };
    }
}
