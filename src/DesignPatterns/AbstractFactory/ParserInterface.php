<?php

namespace DesignPatterns\AbstractFactory;

interface ParserInterface
{

    /**
     * @param mixed $data
     * @return string
     *
     * @throws ParserErrorInterface
     */
    public function encode($data): string;

    /**
     * @param string $content
     * @return mixed
     *
     * @throws ParserErrorInterface
     */
    public function decode(string $content);

}