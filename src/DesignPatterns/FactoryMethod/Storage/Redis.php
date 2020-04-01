<?php

namespace DesignPatterns\FactoryMethod\Storage;

use DesignPatterns\FactoryMethod\StorageInterface;
use Redis as ExtRedis;

class Redis implements StorageInterface
{

    private ExtRedis $redis;

    public function __construct(string $host, int $port)
    {
        $this->redis = new ExtRedis();
        $this->redis->connect($host, $port);
    }

    public function put(string $key, $value): bool
    {
        return $this->redis->set($key, $value);
    }

    public function get(string $key)
    {
        return $this->redis->get('key');
    }

    public function getAll(): array
    {
        $all = [];

        foreach ($this->redis->keys('*') as $key) {
            $all[$key] = $this->get($key);
        }

        return $all;
    }

    public function delete(string $key): bool
    {
        return $this->redis->del($key);
    }

    public function flush(): bool
    {
        return $this->redis->flushDb();
    }

}