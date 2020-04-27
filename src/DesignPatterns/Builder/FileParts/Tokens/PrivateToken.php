<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class PrivateToken extends LevelAccessToken
{

    public function __construct()
    {
        $this->setLevel(parent::PRIVATE);
    }
}