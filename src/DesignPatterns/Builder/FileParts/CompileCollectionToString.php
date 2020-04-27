<?php

namespace DesignPatterns\Builder\FileParts;

trait CompileCollectionToString
{

    /**
     * @param PartInterface[] $parts
     * @return string
     */
    public function compile(array $parts): string
    {
        return array_reduce(
            $parts,
            fn(string $content, PartInterface $part): string => $content.$part,
            ''
        );
    }
}