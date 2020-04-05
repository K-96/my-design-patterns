<?php

namespace DesignPatterns\AbstractFactory;

use \Psr\Http\Message\RequestInterface as PsrRequestInterface;
use \Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * Interface CommunicatorInterface
 * AbstractFactory
 * @package DesignPatterns\AbstractFactory
 */
interface CommunicatorInterface
{

    public function adeptRequest(PsrRequestInterface $request): RequestInterface;
    public function createParser(): ParserInterface;
    public function adeptResponse(PsrResponseInterface $response): ResponseInterface;

}