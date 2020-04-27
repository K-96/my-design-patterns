<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class SpaceToken extends Token
{

    public function __construct(int $count = 1)
    {
        $this->setToken(str_repeat(' ', $count));
    }
}