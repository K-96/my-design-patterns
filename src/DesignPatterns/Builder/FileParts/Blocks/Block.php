<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\CompileCollectionToString;
use DesignPatterns\Builder\FileParts\CountableCollection;
use DesignPatterns\Builder\FileParts\Lines\LineInterface;
use DesignPatterns\Builder\FileParts\PartInterface;

class Block implements BlockInterface
{

    use CompileCollectionToString;
    use CountableCollection;

    /** @var PartInterface[] */
    private array $parts = [];

    public function addLine(LineInterface $line): self
    {
        $this->parts[] = $line;
        return $this;
    }

    public function addBlock(BlockInterface $block): BlockInterface
    {
        $this->parts[] = $block;
        return $this;
    }

    public function count(): int
    {
        return count($this->parts);
    }

    public function __toString()
    {
        return $this->compile($this->parts);
    }
}