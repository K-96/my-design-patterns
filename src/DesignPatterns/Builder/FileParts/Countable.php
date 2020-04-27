<?php

namespace DesignPatterns\Builder\FileParts;

interface Countable
{

    public function count(): int;
    public function isEmpty(): bool;
    public function isNotEmpty(): bool;
}