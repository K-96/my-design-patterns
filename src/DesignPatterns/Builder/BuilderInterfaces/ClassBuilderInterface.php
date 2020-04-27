<?php

namespace DesignPatterns\Builder\BuilderInterfaces;

use DesignPatterns\Builder\BuilderInterfaces\Supports\Inheritance;
use DesignPatterns\Builder\BuilderInterfaces\Supports\MethodsWithBody;
use DesignPatterns\Builder\BuilderInterfaces\Supports\Properties;

interface ClassBuilderInterface extends BuilderInterface, Inheritance, MethodsWithBody, Properties
{

}