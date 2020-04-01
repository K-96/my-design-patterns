<?php

namespace DesignPatterns\FactoryMethod;

use DesignPatterns\FactoryMethod\Storage\Memory;
use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{

    private StorageInterface $storage;

    /**
     * Factory method
     * @return StorageInterface
     */
    public function initStorage(): StorageInterface
    {
        return new Memory();
    }

    private function getStorage(): StorageInterface
    {
        if ($this->storage === null) {
            $this->storage = $this->initStorage();
        }

        return $this->storage;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        return $this->getStorage()->get($key) ?? $default;
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null): bool
    {
        return $this->getStorage()->put($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function delete($key): bool
    {
        return $this->getStorage()->delete($key);
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        return $this->getStorage()->flush();
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null): iterable
    {
        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $this->get($key, $default);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function has($key): bool
    {
        return $this->storage->get($key) !== null;
    }
}