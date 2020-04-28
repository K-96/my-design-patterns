<?php

namespace DesignPatterns\Prototype\Steps;

use DesignPatterns\Prototype\BusinessEntity;
use DesignPatterns\Prototype\Step;

class End implements Step
{

    public string $text = 'end';

    public function execute(BusinessEntity $entity): void
    {
    }
}