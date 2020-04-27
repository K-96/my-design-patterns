<?php

namespace DesignPatterns\Builder\FileParts;

class StringPart implements PartInterface
{

    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __toString()
    {
        return $this->content;
    }
}