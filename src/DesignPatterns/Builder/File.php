<?php

namespace DesignPatterns\Builder;

use DesignPatterns\Builder\FileParts\CompileCollectionToString;
use DesignPatterns\Builder\FileParts\PartInterface;

final class File
{

    use CompileCollectionToString;

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