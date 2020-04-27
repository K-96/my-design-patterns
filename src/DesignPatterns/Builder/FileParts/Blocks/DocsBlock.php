<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\Collections\TupleDocsBlockParams;
use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Templates\InlineDocsBlock;
use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\AtToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\EndDocsBlock;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\StartDocsBlockToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\StarToken;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class DocsBlock extends Block
{

    private iterable $throws;

    /**
     * @param string[] $throws
     */
    public function __construct(iterable $throws = [])
    {
        $this->throws = $throws;
    }

    public function getThrows(): iterable
    {
        return $this->throws;
    }

    public function buildInline(TypeHintToken $hint, Varible $varible): self
    {
        $this->addLine((new Line())
            ->addToken(new SpaceToken(4))
            ->addString(new InlineDocsBlock($hint, $varible))
            ->addToken(new EndLineToken())
        );

        return $this;
    }

    /**
     * @param TupleDocsBlockParams[] $params
     * @return self
     */
    public function buildMultiline(array $params): self {
        if (count($params) === 0) {
            return $this;
        }

        $this->addLine(
            (new Line())
                ->addToken(new SpaceToken(4))
                ->addToken(new StartDocsBlockToken())
                ->addToken(new EndLineToken())
        );

        foreach ($params as $tuple) {
            $line = (new Line())
                ->addToken(new SpaceToken(5))
                ->addToken(new StarToken())
                ->addToken(new SpaceToken())
                ->addToken(new AtToken())
                ->addToken($tuple->getDescriptor());

            if ($tuple->getHint() !== null) {
                $line
                    ->addToken(new SpaceToken())
                    ->addToken($tuple->getHint());
            }

            if ($tuple->getVarible() !== null) {
                $line
                    ->addToken(new SpaceToken())
                    ->addString($tuple->getVarible());
            }

            $line->addToken(new EndLineToken());

            $this->addLine($line);
        }

        $this->addLine(
            (new Line())
                ->addToken(new SpaceToken(4))
                ->addToken(new EndDocsBlock())
                ->addToken(new EndLineToken())
        );

        return $this;
    }

}