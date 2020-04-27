<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class CommaToken extends Token
{

    public function __construct()
    {
        $this->setToken(',');
    }
}