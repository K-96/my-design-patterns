<?php

namespace DesignPatterns\FactoryMethod\Storage;

use DesignPatterns\FactoryMethod\StorageInterface;

class Memory implements StorageInterface
{

    private array $cache;

    public function put(string $key, $value): bool
    {
        $this->cache[$key] = $value;
        return true;
    }

    public function get(string $key)
    {
        return $this->cache[$key] ?? null;
    }

    public function delete(string $key): bool
    {
        unset($this->cache[$key]);
        return true;
    }

    public function getAll(): array
    {
        return $this->cache;
    }

    public function flush(): bool
    {
        $this->cache = [];
        return true;
    }

}