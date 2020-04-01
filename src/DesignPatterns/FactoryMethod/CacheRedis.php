<?php

namespace DesignPatterns\FactoryMethod;

use DesignPatterns\FactoryMethod\Storage\Redis;

class CacheRedis extends Cache
{

    private string $host;
    private int $port;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @inheritDoc
     */
    public function initStorage(): StorageInterface
    {
        return new Redis($this->host, $this->port);
    }

}