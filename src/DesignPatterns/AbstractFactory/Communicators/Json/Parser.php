<?php

namespace DesignPatterns\AbstractFactory\Communicators\Json;

use DesignPatterns\AbstractFactory\ParserInterface;
use JsonException;

class Parser implements ParserInterface
{

    /**
     * @inheritDoc
     */
    public function encode($data): string
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $je) {
            throw new ParserError('Error encode data.', 500, $je);
        }
    }

    /**
     * @inheritDoc
     */
    public function decode(string $content)
    {
        try {
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $je) {
            throw new ParserError('Error decode content.', 500, $je);
        }
    }

}