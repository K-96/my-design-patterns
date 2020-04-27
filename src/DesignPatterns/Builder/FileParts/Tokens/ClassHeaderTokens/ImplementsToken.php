<?php

namespace DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens;

use DesignPatterns\Builder\FileParts\Tokens\Token;

final class ImplementsToken extends Token
{

    public function __construct()
    {
        $this->setToken('implements');
    }
}