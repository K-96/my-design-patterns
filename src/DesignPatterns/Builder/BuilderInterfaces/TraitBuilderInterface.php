<?php

namespace DesignPatterns\Builder\BuilderInterfaces;

use DesignPatterns\Builder\BuilderInterfaces\Supports\AbstractMethod;
use DesignPatterns\Builder\BuilderInterfaces\Supports\MethodsWithoutBody;

interface TraitBuilderInterface extends ClassBuilderInterface, AbstractMethod, MethodsWithoutBody
{

}