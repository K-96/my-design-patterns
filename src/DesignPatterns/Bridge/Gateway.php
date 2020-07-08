<?php

namespace DesignPatterns\Bridge;

use SplFileInfo;

interface Gateway
{

    /**
     * @param string $chatId
     * @param string|null $text
     * @param SplFileInfo[] $attach
     * @param array $callPersons
     */
    public function sendMessage(
        string $chatId,
        ?string $text = null,
        array $attach = [],
        array $callPersons = []
    ): void;
    public function readChat(string $chatId, ?int $limit = null, int $offset = null): array;
    public function countMessageInChat(string $chatId): int;
}