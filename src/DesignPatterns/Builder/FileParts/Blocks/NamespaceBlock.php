<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\Lines\EmptyLine;
use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\NamespaceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\SemicolonToken;

class NamespaceBlock extends Block
{

    public function __construct(string $namespace)
    {
        $line = (new Line())
            ->addToken(new NamespaceToken())
            ->addToken(new SpaceToken())
            ->addString($namespace)
            ->addToken(new SemicolonToken())
            ->addToken(new EndLineToken());

        $this->addLine($line);
        $this->addLine(new EmptyLine());
    }
}