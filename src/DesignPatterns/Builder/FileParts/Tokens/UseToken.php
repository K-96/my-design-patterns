<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class UseToken extends Token
{

    public function __construct()
    {
        $this->setToken('use');
    }
}