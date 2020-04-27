<?php

namespace DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens;

use DesignPatterns\Builder\FileParts\Tokens\Token;

final class VarToken extends Token
{

    public function __construct()
    {
        $this->setToken('var');
    }
}