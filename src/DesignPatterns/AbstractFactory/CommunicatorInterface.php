<?php

namespace DesignPatterns\AbstractFactory;

/**
 * Interface CommunicatorInterface
 * AbstractFactory
 * @package DesignPatterns\AbstractFactory
 */
interface CommunicatorInterface
{

    public function createRequest(): RequestInterface;
    public function createParser(): ParserInterface;
    public function createResponse(): ResponseInterface;

}