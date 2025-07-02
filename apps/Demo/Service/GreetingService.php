<?php
namespace Apps\Demo\Service;

class GreetingService
{
    public function greet(string $name): string
    {
        return "Hello, {$name}!";
    }
}
