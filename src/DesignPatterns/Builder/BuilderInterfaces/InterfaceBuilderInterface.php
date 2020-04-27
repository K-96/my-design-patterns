<?php

namespace DesignPatterns\Builder\BuilderInterfaces;

use DesignPatterns\Builder\BuilderInterfaces\Supports\MethodsWithoutBody;
use DesignPatterns\Builder\BuilderInterfaces\Supports\MultiInheritance;

interface InterfaceBuilderInterface extends BuilderInterface, MethodsWithoutBody, MultiInheritance
{

}