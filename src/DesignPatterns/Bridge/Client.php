<?php

namespace DesignPatterns\Bridge;

use SplFileInfo;

class Client
{
    private Gateway $gate;

    public function __construct(Gateway $gate)
    {
        $this->gate = $gate;
    }

    public function sendMessage(string $chatId, string $text): void
    {
        $this->gate->sendMessage($chatId, $text);
    }

    public function sendFile(string $chatId, SplFileInfo $file): void
    {
        $this->gate->sendMessage($chatId, null, [$file]);
    }

    public function fetchLastMessage(string $chatId): ?string
    {
        $result = $this->gate->readChat($chatId, 1, $this->gate->countMessageInChat($chatId) - 1);

        return $result[0] ?? null;
    }

    public function fetchAllMessage(string $chatId): array
    {
        return $this->gate->readChat($chatId);
    }
}