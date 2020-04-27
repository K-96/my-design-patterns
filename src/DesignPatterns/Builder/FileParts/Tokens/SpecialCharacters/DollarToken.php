<?php

namespace DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters;

use DesignPatterns\Builder\FileParts\Tokens\Token;

final class DollarToken extends Token
{

    public function __construct()
    {
        $this->setToken('$');
    }
}