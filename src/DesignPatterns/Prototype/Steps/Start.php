<?php

namespace DesignPatterns\Prototype\Steps;

use DesignPatterns\Prototype\BusinessEntity;
use DesignPatterns\Prototype\Step;

class Start implements Step
{

    public string $text = 'start';

    public function execute(BusinessEntity $entity): void
    {
    }
}