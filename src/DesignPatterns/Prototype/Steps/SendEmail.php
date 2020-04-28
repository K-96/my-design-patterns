<?php

namespace DesignPatterns\Prototype\Steps;

use DesignPatterns\Prototype\BusinessEntity;
use DesignPatterns\Prototype\Step;

class SendEmail implements Step
{

    public function execute(BusinessEntity $entity): void
    {
    }
}