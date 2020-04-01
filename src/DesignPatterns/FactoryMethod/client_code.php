<?php

use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException as CacheInvalidArgumentException;
use DesignPatterns\FactoryMethod;

function clientCode(CacheInterface $cache): void {
    $key = 'some-date';

    try {
        $date = $cache->get($key, time());

        try {
            $date = new DateTime("@{$date}");
        } catch (Exception $dte) {
            $date = new DateTime('now');
        }

        $date->add(new DateInterval('P1D'));

        $cache->set($key, $date->getTimestamp(), new DateInterval('PT24H'));
    } catch (CacheInvalidArgumentException $ce) {
    }
}

clientCode(new FactoryMethod\Cache());
clientCode(new FactoryMethod\CacheRedis(
         getenv('REDIS_HOST'),
    (int)getenv('REDIS_PORT')
));