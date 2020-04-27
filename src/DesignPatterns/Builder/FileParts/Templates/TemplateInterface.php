<?php

namespace DesignPatterns\Builder\FileParts\Templates;

use DesignPatterns\Builder\FileParts\PartInterface;

interface TemplateInterface extends PartInterface
{

    public function addPart(PartInterface $part): self;
}