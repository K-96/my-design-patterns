<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\Collections\TupleDocsBlockParams;
use DesignPatterns\Builder\Collections\TupleParams;
use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Tokens\CommaToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\ParamToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\ReturnToken;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\ThrowToken;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\FunctionToken;
use DesignPatterns\Builder\FileParts\Tokens\LevelAccessToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\CloseBraceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\CloseParenthesisToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\ColonToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\OpenBraceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\OpenParenthesisToken;
use DesignPatterns\Builder\FileParts\Tokens\Token;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class MethodBlock extends Block
{

    /**
     * @param LevelAccessToken $access
     * @param Token $name
     * @param TypeHintToken $return
     * @param TupleParams[] $params
     * @param DocsBlock|null $docsBlock
     */
    public function __construct(
        LevelAccessToken $access,
        Token $name,
        TypeHintToken $return = null,
        array $params = [],
        DocsBlock $docsBlock = null
    ) {
        if ($docsBlock !== null) {
            $tuples = [];

            foreach ($params as $param) {
                $tuples[] = new TupleDocsBlockParams(
                    new ParamToken(),
                    $param->getHint(),
                    $param->getVarible()
                );
            }

            if ($return !== null) {
                $tuples[] = new TupleDocsBlockParams(new ReturnToken(), $return);
            }

            foreach ($docsBlock->getThrows() as $throw) {
                $tuples[] = new TupleDocsBlockParams(new ThrowToken(), $throw);
            }

            $this->addBlock($docsBlock->buildMultiline($tuples));
        }

        $line = (new Line())
            ->addToken(new SpaceToken(4))
            ->addToken($access)
            ->addToken(new SpaceToken())
            ->addToken(new FunctionToken())
            ->addToken(new SpaceToken())
            ->addToken($name)
            ->addToken(new OpenParenthesisToken());

        $elementCount = 1;

        foreach ($params as $param) {
            if ($param->getHint() !== null) {
                $line
                    ->addToken($param->getHint())
                    ->addToken(new SpaceToken());
            }

            $line->addString($param->getVarible());

            if ($elementCount !== count($params)) {
                $line
                    ->addToken(new CommaToken())
                    ->addToken(new SpaceToken());
            }

            $elementCount++;
        }

        $line->addToken(new CloseParenthesisToken());

        if ($return !== null) {
            $line
                ->addToken(new ColonToken())
                ->addToken(new SpaceToken())
                ->addToken($return);
        }

        $line->addToken(new EndLineToken());

        $this->addLine($line);

        $openMethodLine = (new Line())
            ->addToken(new SpaceToken(4))
            ->addToken(new OpenBraceToken())
            ->addToken(new EndLineToken());

        $this->addLine($openMethodLine);

        $closeMethodLine = (new Line())
            ->addToken(new SpaceToken(4))
            ->addToken(new CloseBraceToken())
            ->addToken(new EndLineToken());

        $this->addLine($closeMethodLine);
    }

}