<?php

namespace DesignPatterns\Builder\FileParts\Templates;

use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens\ClassToken;
use DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens\ExtendsToken;
use DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens\ImplementsToken;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;
use DesignPatterns\Builder\FileParts\Tokens\Token;
use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;
use DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens\AbstractToken;
use DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens\FinalToken;
use RuntimeException;

class ClassHeader extends Template
{

    public const REGULAR  = 0;
    public const FINAL    = 1;
    public const ABSTRACT = 2;

    private ?Token $abstractOrFinal = null;
    private ClassNameToken $name;
    private ?ClassNameToken $extended = null;
    private ?ImplementsClassNames $implements = null;

    public function __construct(ClassNameToken $name)
    {
        $this->name = $name;
    }

    public function as(int $type): self
    {
        switch ($type) {
            case self::REGULAR:
                $this->abstractOrFinal = null; break;
            case self::FINAL:
                $this->abstractOrFinal = new FinalToken(); break;
            case self::ABSTRACT:
                $this->abstractOrFinal = new AbstractToken(); break;
            default:
                throw new RuntimeException("Received type: '$type'. This incorrect type.");
        }

        return $this;
    }

    public function extended(ClassNameToken $extended): self
    {
        $this->extended = $extended;
        return $this;
    }

    public function implements(ImplementsClassNames $implements): self
    {
        $this->implements = $implements;
        return $this;
    }

    public function build(): self
    {
        $line = new Line();

        if ($this->abstractOrFinal !== null) {
            $line
                ->addToken($this->abstractOrFinal)
                ->addToken(new SpaceToken());
        }

        $line
            ->addToken(new ClassToken())
            ->addToken(new SpaceToken())
            ->addToken($this->name);

        if ($this->extended !== null) {
            $line
                ->addToken(new SpaceToken())
                ->addToken(new ExtendsToken())
                ->addToken(new SpaceToken())
                ->addToken($this->extended);
        }

        if ($this->implements !== null) {
            $line
                ->addToken(new SpaceToken())
                ->addToken(new ImplementsToken())
                ->addToken(new SpaceToken())
                ->addString($this->implements);
        }

        $line->addToken(new EndLineToken());
        $this->addPart($line);

        return $this;
    }

    public function __toString()
    {
        $this->build();

        return parent::__toString();
    }
}