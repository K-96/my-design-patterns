<?php

namespace DesignPatterns\Builder\BuilderInterfaces\Supports;

interface MethodsWithoutBody
{

    public function setMethodWithoutBody(array $params): self;
}