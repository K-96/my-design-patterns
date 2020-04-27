<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class EndLineToken extends Token
{

    public function __construct()
    {
        $this->setToken(PHP_EOL);
    }
}