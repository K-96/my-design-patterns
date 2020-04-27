<?php

namespace DesignPatterns\Builder\FileParts\Templates;

use DesignPatterns\Builder\FileParts\CompileCollectionToString;
use DesignPatterns\Builder\FileParts\PartInterface;

class Template implements TemplateInterface
{

    use CompileCollectionToString;

    /** @var PartInterface[] */
    private array $parts = [];

    public function addPart(PartInterface $part): self
    {
        $this->parts[] = $part;
        return $this;
    }

    public function __toString()
    {
        return $this->compile($this->parts);
    }
}