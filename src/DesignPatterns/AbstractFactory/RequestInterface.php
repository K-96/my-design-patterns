<?php

namespace DesignPatterns\AbstractFactory;

interface RequestInterface
{

    /**
     * @return string
     * @throws ContentErrorInterface
     */
    public function extractContent(): string;

}