<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Templates\InlineDocsBlock;
use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\LevelAccessToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\SemicolonToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class PropertyBlock extends Block
{

    public function __construct(
        Varible $varible,
        LevelAccessToken $access,
        TypeHintToken $hint = null,
        bool $addDocsBlock = false
    ) {
        if ($addDocsBlock && $hint !== null) {
            $this->addLine((new Line())
                ->addToken(new SpaceToken(4))
                ->addString(new InlineDocsBlock($hint))
                ->addToken(new EndLineToken())
            );
        }

        $this->addLine((new Line())
            ->addToken(new SpaceToken(4))
            ->addToken($access)
            ->addToken(new SpaceToken())
            ->addString($hint !== null ? $hint .  (new SpaceToken()) : '')
            ->addString($varible)
            ->addToken(new SemicolonToken())
            ->addToken(new EndLineToken())
        );
    }
}