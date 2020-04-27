<?php

namespace DesignPatterns\Builder\BuilderInterfaces\Supports;

interface MultiInheritance
{

    /**
     * @param string[] $names
     * @return $this
     */
    public function setParent(array $names): self;
}