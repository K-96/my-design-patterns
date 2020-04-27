<?php

namespace DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens;

final class ParamToken extends DescriptorToken
{

    public function __construct()
    {
        $this->setType(parent::PARAM);
    }
}