<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class FunctionNameToken extends Token
{

    public function __construct(string $name)
    {
        $this->setToken($name);
    }
}