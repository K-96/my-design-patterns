<?php

namespace DesignPatterns\Builder\FileParts\Lines;

use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\SemicolonToken;
use DesignPatterns\Builder\FileParts\Tokens\UseToken;

class ImportClass extends Line
{

    public function __construct(ClassNameToken $name)
    {
        $this
            ->addToken(new UseToken())
            ->addToken(new SpaceToken())
            ->addToken($name)
            ->addToken(new SemicolonToken())
            ->addToken(new EndLineToken());
    }
}