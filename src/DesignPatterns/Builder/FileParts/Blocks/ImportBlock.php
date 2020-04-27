<?php

namespace DesignPatterns\Builder\FileParts\Blocks;

use DesignPatterns\Builder\FileParts\Lines\EmptyLine;
use DesignPatterns\Builder\FileParts\Lines\ImportClass;
use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;

class ImportBlock extends Block
{


    /**
     * @param ClassNameToken|string[] $classNames
     */
    public function __construct(array $classNames)
    {
        foreach ($classNames as $name) {
            $partName = $name instanceof ClassNameToken ? $name : new ClassNameToken($name);

            $this->addLine(new ImportClass($partName));
        }

        $this->addLine(new EmptyLine());
    }
}