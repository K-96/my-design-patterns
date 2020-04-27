<?php

namespace DesignPatterns\Builder\FileParts\Templates;

use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\AtToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\EndDocsBlock;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\StartDocsBlockToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\VarToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class InlineDocsBlock extends Template
{

    public function __construct(TypeHintToken $hint, Varible $varible = null)
    {
        $this
            ->addPart(new StartDocsBlockToken())
            ->addPart(new SpaceToken())
            ->addPart(new AtToken())
            ->addPart(new VarToken())
            ->addPart(new SpaceToken())
            ->addPart($hint)
            ->addPart(new SpaceToken());

        if ($varible !== null) {
            $this
                ->addPart($varible)
                ->addPart(new SpaceToken());
        }

        $this->addPart(new EndDocsBlock());
    }
}