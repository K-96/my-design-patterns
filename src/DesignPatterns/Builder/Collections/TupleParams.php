<?php

namespace DesignPatterns\Builder\Collections;

use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class TupleParams
{

    private Varible $varible;
    private ?TypeHintToken $hint;

    public function __construct(
        Varible $varible,
        TypeHintToken $hint = null
    ) {
        $this->varible = $varible;
        $this->hint = $hint;
    }

    public function getVarible(): Varible
    {
        return $this->varible;
    }

    public function getHint(): ?TypeHintToken
    {
        return $this->hint;
    }

}