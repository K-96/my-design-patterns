<?php

namespace DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens;

final class ClassToken extends ClassTypeToken
{

    public function __construct()
    {
        $this->setType(parent::CLASS_T);
    }
}