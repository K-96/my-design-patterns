<?php

namespace DesignPatterns\Builder\FileParts\Tokens;

class Token implements TokenInterface
{

    private string $token = '';

    protected function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function __toString()
    {
       return $this->token;
    }
}