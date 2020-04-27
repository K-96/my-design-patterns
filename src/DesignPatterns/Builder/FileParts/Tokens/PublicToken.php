<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class PublicToken extends LevelAccessToken
{

    public function __construct()
    {
        $this->setLevel(parent::PUBLIC);
    }
}