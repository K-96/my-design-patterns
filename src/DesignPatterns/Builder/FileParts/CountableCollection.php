<?php

namespace DesignPatterns\Builder\FileParts;

trait CountableCollection
{

    abstract public function count(): int;

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }
}