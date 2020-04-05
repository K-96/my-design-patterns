<?php

namespace DesignPatterns\AbstractFactory;

use \Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseInterface
{

    public function setContent(string $content): void;
    public function getResponse(): PsrResponseInterface;

}