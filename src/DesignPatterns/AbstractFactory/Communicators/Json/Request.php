<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\RequestInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;

class Request implements RequestInterface
{

    private PsrRequestInterface $request;
    private string $contentType = 'application/json';

    public function __construct(PsrRequestInterface $request)
    {
        $this->request = $request;
    }

    public function extractContent(): string
    {
        if ($this->contentType !== $this->request->getHeader('content-type')) {
            throw new ContentError('Invalid "content-type" header for json format.', 415);
        }

        return $this->request->getBody()->getContents();
    }

}