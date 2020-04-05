<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\ParserErrorInterface;
use RuntimeException;

class ParserError extends RuntimeException implements ParserErrorInterface
{

}