<?php

namespace DesignPatterns\Builder\FileParts\Lines;

use DesignPatterns\Builder\FileParts\CompileCollectionToString;
use DesignPatterns\Builder\FileParts\CountableCollection;
use DesignPatterns\Builder\FileParts\StringPart;
use DesignPatterns\Builder\FileParts\Tokens\TokenInterface;

class Line implements LineInterface
{

    use CompileCollectionToString;
    use CountableCollection;

    /** @var TokenInterface|string[] */
    private array $parts = [];

    public function addToken(TokenInterface $token): LineInterface
    {
        $this->parts[] = $token;
        return $this;
    }

    public function addString(string $content): LineInterface
    {
        $this->parts[] = new StringPart($content);
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