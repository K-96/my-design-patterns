<?php

namespace DesignPatterns\Prototype;

interface Step
{

    public function execute(BusinessEntity $entity): void;
}