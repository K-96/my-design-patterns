<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

use RuntimeException;

abstract class LevelAccessToken extends Token
{

    public const PUBLIC    = 0;
    public const PROTECTED = 1;
    public const PRIVATE   = 2;

    public function setLevel(int $level): void
    {
        switch ($level) {
            case self::PUBLIC:
                $this->setToken('public'); return;
            case self::PROTECTED:
                $this->setToken('protected'); return;
            case self::PRIVATE:
                $this->setToken('private'); return;
            default:
                throw new RuntimeException("Received level: '$level'. This incorrect level.");
        }
    }
}