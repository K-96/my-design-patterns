<?php

namespace DesignPatterns\Builder\BuilderInterfaces;

use DesignPatterns\Builder\File;

interface BuilderInterface
{

    public function setFile(File $file): self;

    public function setNamespace(string $namespace): self;

    /**
     * @param string[] $imports
     * @return $this
     */
    public function setImports(array $imports): self;

    public function setClassName(string $name): self;

    public function build(string $name = null): File;
}