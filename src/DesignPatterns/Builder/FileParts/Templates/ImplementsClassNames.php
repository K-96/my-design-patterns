<?php

namespace DesignPatterns\Builder\FileParts\Templates;

use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;
use DesignPatterns\Builder\FileParts\Tokens\CommaToken;
use DesignPatterns\Builder\FileParts\Tokens\SpaceToken;

class ImplementsClassNames extends Template
{

    /**
     * @param ClassNameToken|string[] $classNames
     */
    public function __construct(array $classNames)
    {
        $lastElement = count($classNames) - 1;
        $elementCount = 0;

        foreach ($classNames as $name) {
            $this->addPart($name instanceof ClassNameToken ? $name : new ClassNameToken($name));

            if ($elementCount !== $lastElement) {
                $this->addPart(new CommaToken())
                    ->addPart(new SpaceToken());
            }

            ++$elementCount;
        }
    }
}