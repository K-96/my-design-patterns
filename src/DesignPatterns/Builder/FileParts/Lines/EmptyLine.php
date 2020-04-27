<?php

namespace DesignPatterns\Builder\FileParts\Lines;

use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;

class EmptyLine extends Line
{

    public function __construct()
    {
        $this->addToken(new EndLineToken());
    }
}