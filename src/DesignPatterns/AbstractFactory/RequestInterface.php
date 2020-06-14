<?php

namespace DesignPatterns\AbstractFactory;
use \Psr\Http\Message\RequestInterface as PsrRequestInterface;

interface RequestInterface
{

    /**
     * @return string
     * @throws ContentErrorInterface
     */
    public function extractContent(): string;
    public function adept(PsrRequestInterface $request): self;

}