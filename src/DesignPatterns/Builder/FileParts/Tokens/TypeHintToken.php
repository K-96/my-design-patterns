<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

class TypeHintToken extends Token
{

    public function __construct(string $typeHint)
    {
        $this->setToken($typeHint);
    }
}