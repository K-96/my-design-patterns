<?php

namespace DesignPatterns\Builder\Collections;

use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens\DescriptorToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;

class TupleDocsBlockParams
{

    private DescriptorToken $descriptor;
    private ?Varible $varible;
    private ?TypeHintToken $hint;

    public function __construct(
        DescriptorToken $descriptor,
        TypeHintToken $hint = null,
        Varible $varible = null
    ) {
        $this->descriptor = $descriptor;
        $this->varible = $varible;
        $this->hint = $hint;
    }

    public function getDescriptor(): DescriptorToken
    {
        return $this->descriptor;
    }

    public function getVarible(): ?Varible
    {
        return $this->varible;
    }

    public function getHint(): ?TypeHintToken
    {
        return $this->hint;
    }
}