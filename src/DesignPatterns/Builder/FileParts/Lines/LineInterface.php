<?php

namespace DesignPatterns\Builder\FileParts\Lines;

use DesignPatterns\Builder\FileParts\Countable;
use DesignPatterns\Builder\FileParts\PartInterface;
use DesignPatterns\Builder\FileParts\Tokens\TokenInterface;

interface LineInterface extends PartInterface, Countable
{

    public function addToken(TokenInterface $token): self;
    public function addString(string $content): self;
}