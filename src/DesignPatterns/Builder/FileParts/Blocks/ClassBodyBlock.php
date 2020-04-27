<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\Lines\EmptyLine;
use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Tokens\EndLineToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\CloseBraceToken;
use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\OpenBraceToken;

class ClassBodyBlock extends Block
{

    private PropertiesBlock $properties;
    private MethodsBlock $methods;

    public function __construct()
    {
        $this->properties = new PropertiesBlock();
        $this->methods = new MethodsBlock();
    }

    public function addProperty(PropertyBlock $property): self
    {
        $this->properties->addBlock($property);
        return $this;
    }

    public function addMethod(MethodBlock $method): self
    {
        $this->methods->addLine(new EmptyLine());
        $this->methods->addBlock($method);
        return $this;
    }

    public function __toString()
    {
        $startBody = (new Line())
            ->addToken(new OpenBraceToken())
            ->addToken(new EndLineToken());
        $this->addLine($startBody);

        $body = new Block();
        $body->addLine(new EmptyLine());

        if ($this->properties->isNotEmpty()) {
            $body->addBlock($this->properties);
        }
        if ($this->methods->isNotEmpty()) {
            $body->addBlock($this->methods);
        }

        $this->addBlock($body);

        $endBody = (new Line())->addToken(new CloseBraceToken());
        $this->addLine($endBody);

        return parent::__toString();
    }
}