<?php

namespace DesignPatterns\Builder\BuilderInterfaces\Supports;

interface MethodsWithBody
{

    public function setMethod(array $params): self;
}