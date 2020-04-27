<?php

namespace DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens;

final class ReturnToken extends DescriptorToken
{

    public function __construct()
    {
        $this->setType(parent::RETURN);
    }
}