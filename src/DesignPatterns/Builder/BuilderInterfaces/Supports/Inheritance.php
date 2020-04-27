<?php

namespace DesignPatterns\Builder\BuilderInterfaces\Supports;

interface Inheritance
{

    public function setParent(string $name): self;
}