<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\CommunicatorInterface;
use DesignPatterns\AbstractFactory\ParserInterface;
use DesignPatterns\AbstractFactory\RequestInterface;
use DesignPatterns\AbstractFactory\ResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Communicator implements CommunicatorInterface
{

    private TypesFromDecode $typesFromDecode;

    public function __construct(TypesFromDecode $typesFromDecode1)
    {
        $this->typesFromDecode = $typesFromDecode1;
    }

    public function adeptRequest(PsrRequestInterface $request): RequestInterface
    {
        return new Request($request);
    }

    public function createParser(): ParserInterface
    {
        return new Parser($this->typesFromDecode);
    }

    public function adeptResponse(PsrResponseInterface $response): ResponseInterface
    {
        return new Response($response);
    }

}