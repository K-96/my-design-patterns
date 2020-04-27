<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class ProtectedToken extends LevelAccessToken
{

    public function __construct()
    {
        $this->setLevel(parent::PROTECTED);
    }
}