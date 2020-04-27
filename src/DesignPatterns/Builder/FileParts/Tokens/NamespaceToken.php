<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class NamespaceToken extends Token
{

    public function __construct()
    {
        $this->setToken('namespace');
    }
}