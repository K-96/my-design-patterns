<?php

namespace DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens;

final class ThrowToken extends DescriptorToken
{

    public function __construct()
    {
        $this->setType(parent::THROWS);
    }
}