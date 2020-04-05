<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface
{

    private PsrResponseInterface $response;
    private string $contentType = 'application/json';

    public function __construct(PsrResponseInterface $response)
    {
        $this->response = $response;
    }

    public function setContent(string $content): void
    {
        $body = $this->response->getBody();
        $body->write($content);

        $this->response->withBody($body);

        $this->response->withHeader('content-type', $this->contentType);
    }

    public function getResponse(): PsrResponseInterface
    {
        return $this->response;
    }

}