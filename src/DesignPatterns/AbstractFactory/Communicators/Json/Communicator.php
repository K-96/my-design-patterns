<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\CommunicatorInterface;
use DesignPatterns\AbstractFactory\ParserInterface;
use DesignPatterns\AbstractFactory\RequestInterface;
use DesignPatterns\AbstractFactory\ResponseInterface;

class Communicator implements CommunicatorInterface
{

    public function createRequest(): RequestInterface
    {
        return new Request();
    }

    public function createParser(): ParserInterface
    {
        return new Parser();
    }

    public function createResponse(): ResponseInterface
    {
        return new Response();
    }

}