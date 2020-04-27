<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

final class OpenTagToken extends Token
{

    public function __construct()
    {
        $this->setToken('<?php');
    }
}