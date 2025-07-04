<?php
namespace KoruPHP\Core;

class Container
{
    private array $entries = [];

    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (!isset($this->entries[$id])) {
            throw new \RuntimeException("Service '$id' not found");
        }
        return $this->entries[$id]();
    }
}
