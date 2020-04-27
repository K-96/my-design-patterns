<?php

namespace DesignPatterns\Builder\BuilderInterfaces\Supports;

interface Properties
{

    public function setProperty(array $params): self;
}