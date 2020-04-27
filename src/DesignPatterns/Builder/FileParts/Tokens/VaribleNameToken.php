<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class VaribleNameToken extends Token
{

    public function __construct(string $name)
    {
        $this->setToken($name);
    }
}