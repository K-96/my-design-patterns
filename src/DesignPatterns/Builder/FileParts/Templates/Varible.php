<?php

namespace DesignPatterns\Builder\FileParts\Templates;

use DesignPatterns\Builder\FileParts\Tokens\SpecialCharacters\DollarToken;
use DesignPatterns\Builder\FileParts\Tokens\VaribleNameToken;

class Varible extends Template
{

    public function __construct(string $name)
    {
        $this
            ->addPart(new DollarToken())
            ->addPart(new VaribleNameToken($name));
    }
}