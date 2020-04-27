<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\Collections\TupleParams;
use DesignPatterns\Builder\FileParts\Lines\Line;
use DesignPatterns\Builder\FileParts\Templates\ClassHeader;
use DesignPatterns\Builder\FileParts\Templates\ImplementsClassNames;
use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;
use DesignPatterns\Builder\FileParts\Tokens\FunctionNameToken;
use DesignPatterns\Builder\FileParts\Tokens\LevelAccessToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class ClassBlock extends Block
{

    protected ClassHeader $classHeader;
    protected ClassBodyBlock $classBody;

    public function __construct(ClassNameToken $name)
    {
        $this->classHeader = new ClassHeader($name);
        $this->classBody = new ClassBodyBlock();
    }

    public function asRegularClass(): self
    {
        $this->classHeader->as(ClassHeader::REGULAR);
        return $this;
    }

    public function asAbstractClass(): self
    {
        $this->classHeader->as(ClassHeader::ABSTRACT);
        return $this;
    }

    public function asFinalClass(): self
    {
        $this->classHeader->as(ClassHeader::FINAL);
        return $this;
    }

    public function extended(ClassNameToken $extended): self
    {
        $this->classHeader->extended($extended);
        return $this;
    }

    public function implements(ImplementsClassNames $implements): self
    {
        $this->classHeader->implements($implements);
        return $this;
    }

    public function addProperty(
        Varible $varible,
        LevelAccessToken $access,
        TypeHintToken $hint = null,
        bool $addDocsBlock = false
    ): self {
        $this->classBody->addProperty(new PropertyBlock($varible, $access, $hint, $addDocsBlock));
        return $this;
    }

    /**
     * @param LevelAccessToken $access
     * @param string $name
     * @param TypeHintToken $return
     * @param TupleParams[] $params
     * @param DocsBlock|null $docsBlock
     * @return ClassBlock
     */
    public function addMethod(
        LevelAccessToken $access,
        FunctionNameToken $name,
        TypeHintToken $return = null,
        array $params = [],
        DocsBlock $docsBlock = null
    ): self {
        $this->classBody->addMethod(new MethodBlock($access, $name, $return, $params, $docsBlock));
        return $this;
    }

    public function __toString()
    {
        $this->addLine((new Line())->addString($this->classHeader));
        $this->addBlock($this->classBody);

        return parent::__toString();
    }
}