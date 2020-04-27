<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\Lines\EmptyLine;
use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\OpenTagToken;

class StartFileBlock extends Block
{

    public function __construct()
    {
        $startLine = (new Line())
            ->addToken(new OpenTagToken())
            ->addToken(new EndLineToken());

        $this->addLine($startLine);
        $this->addLine(new EmptyLine());
    }

}