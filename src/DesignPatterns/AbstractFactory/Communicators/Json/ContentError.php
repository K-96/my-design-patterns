<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\ContentErrorInterface;
use RuntimeException;

class ContentError extends RuntimeException implements ContentErrorInterface
{

}