<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\ContentErrorInterface;
use Exception;

class ContentError extends Exception implements ContentErrorInterface
{

}