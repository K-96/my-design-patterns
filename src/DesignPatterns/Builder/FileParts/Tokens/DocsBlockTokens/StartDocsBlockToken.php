<?php

namespace DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens;

use DesignPatterns\Builder\FileParts\Tokens\Token;

final class StartDocsBlockToken extends Token
{

    public function __construct()
    {
        $this->setToken('/**');
    }
}