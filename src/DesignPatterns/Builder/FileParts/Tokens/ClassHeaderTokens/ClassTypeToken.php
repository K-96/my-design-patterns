<?php

namespace DesignPatterns\Builder\FileParts\Tokens\ClassHeaderTokens;

use DesignPatterns\Builder\FileParts\Tokens\Token;
use RuntimeException;

abstract class ClassTypeToken extends Token
{

    public const CLASS_T     = 0;
    public const INTERFACE_T = 1;
    public const TRAIT_T     = 2;

    public function setType(int $type): void
    {
        switch ($type) {
            case self::CLASS_T:
                $this->setToken('class'); return;
            case self::INTERFACE_T:
                $this->setToken('interface'); return;
            case self::TRAIT_T:
                $this->setToken('trait'); return;
            default:
                throw new RuntimeException("Received type: '$type'. This incorrect type.");
        }
    }

}