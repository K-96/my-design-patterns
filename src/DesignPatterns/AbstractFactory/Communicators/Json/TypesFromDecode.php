<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

class TypesFromDecode
{

    public const ARRAY = true;
    public const OBJECT = false;

    private bool $type;

    public function __construct(bool $type)
    {
        $this->type = $type;
    }

    public function getType(): bool
    {
        return $this->type;
    }

}