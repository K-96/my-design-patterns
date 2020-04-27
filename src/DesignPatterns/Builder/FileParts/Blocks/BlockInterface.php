<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\Countable;
use DesignPatterns\Builder\FileParts\Lines\LineInterface;
use DesignPatterns\Builder\FileParts\PartInterface;

interface BlockInterface extends PartInterface, Countable
{

    public function addLine(LineInterface $line): self;
    public function addBlock(BlockInterface $block): self;
}