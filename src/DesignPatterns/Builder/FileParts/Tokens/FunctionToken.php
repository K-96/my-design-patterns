<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class FunctionToken extends Token
{

    public function __construct()
    {
        $this->setToken('function');
    }
}