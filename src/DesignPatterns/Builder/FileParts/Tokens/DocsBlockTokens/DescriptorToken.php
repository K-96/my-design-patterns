<?php

namespace DesignPatterns\Builder\FileParts\Tokens\DocsBlockTokens;

use DesignPatterns\Builder\FileParts\Tokens\Token;
use RuntimeException;

abstract class DescriptorToken extends Token
{

    public const PARAM = 0;
    public const RETURN = 1;
    public const THROWS = 2;

    public function setType(int $type): void
    {
        switch ($type) {
            case self::PARAM:
                $this->setToken('param'); return;
            case self::RETURN:
                $this->setToken('return'); return;
            case self::THROWS:
                $this->setToken('throws'); return;
            default:
                throw new RuntimeException("Received type: '$type'. This incorrect type.");
        }
    }
}