<?php

namespace DesignPatterns\FactoryMethod;

interface StorageInterface
{

    public function put(string $key, $value): bool;
    public function get(string $key);
    public function getAll(): array;
    public function delete(string $key): bool;
    public function flush(): bool;

}