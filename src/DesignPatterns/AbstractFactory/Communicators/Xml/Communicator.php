<?php

namespace DesignPatterns\AbstractFactory\Communicators\Xml;

use DesignPatterns\AbstractFactory\CommunicatorInterface;
use DesignPatterns\AbstractFactory\ParserInterface;
use DesignPatterns\AbstractFactory\RequestInterface;
use DesignPatterns\AbstractFactory\ResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Communicator implements CommunicatorInterface
{

    public function adeptRequest(PsrRequestInterface $request): RequestInterface
    {
        // TODO: Implement adeptRequest() method.
    }

    public function createParser(): ParserInterface
    {
        // TODO: Implement createParser() method.
    }

    public function adeptResponse(PsrResponseInterface $response): ResponseInterface
    {
        // TODO: Implement adeptResponse() method.
    }

}