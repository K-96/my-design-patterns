<?php

namespace DesignPatterns\AbstractFactory\Communicators\Xml;

use DesignPatterns\AbstractFactory\CommunicatorInterface;
use DesignPatterns\AbstractFactory\ParserInterface;
use DesignPatterns\AbstractFactory\RequestInterface;
use DesignPatterns\AbstractFactory\ResponseInterface;

class Communicator implements CommunicatorInterface
{

    public function createRequest(): RequestInterface
    {
        // TODO: Implement adeptRequest() method.
    }

    public function createParser(): ParserInterface
    {
        // TODO: Implement createParser() method.
    }

    public function createResponse(): ResponseInterface
    {
        // TODO: Implement adeptResponse() method.
    }

}