<?php

namespace DesignPatterns\Bridge\Gateway;

use DesignPatterns\Bridge\Gateway;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Telegram
 *
 * Описанная интеграция не является рабочей, все HTTP запрос я придумал сам =)
 *
 * @package DesignPatterns\Bridge\Gateway
 */
class Telegram implements Gateway
{
    private string $key;
    private ClientInterface $httpClient;
    private RequestFactoryInterface $factory;

    public function __construct(string $key, ClientInterface $httpClient, RequestFactoryInterface $factory)
    {
        $this->key = $key;
        $this->httpClient = $httpClient;
        $this->factory = $factory;
    }

    public function sendMessage(string $chatId, ?string $text = null, array $attach = [], array $callPersons = []): void
    {
        $calls = implode(' ', array_map(fn(string $person) => "@{$person}", $callPersons));

        $text = is_null($text) ? $calls : $text . $calls;

        $this->sendRequest('send', [
            'text' => $text,
            'chat_id' => $chatId,
        ]);

        foreach ($attach as $file) {
            $this->sendRequest('send_file', [
                'chat_id' => $chatId,
                'file' => $file->openFile()->fread($file->getSize()),
            ]);
        }
    }

    public function readChat(string $chatId, ?int $limit = null, int $offset = null): array
    {
        $response = $this->sendRequest('read', [
            'limit' => $limit,
            'offset' => $offset,
            'chat_id' => $chatId,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function countMessageInChat(string $chatId): int
    {
        $response = $this->sendRequest('count_message', [
            'chat_id' => $chatId,
        ]);

        return json_decode($response->getBody()->getContents(), true)['count'] ?? 0;
    }

    private function sendRequest(string $method, array $params = []): ResponseInterface
    {
        return $this->httpClient->sendRequest($this->prepareRequest($method, $params));
    }

    private function prepareRequest(string $method, array $params = []): RequestInterface
    {
        $request = $this->factory->createRequest(
            'GET',
            'https://telegram.api.host/' . $method . '?' . http_build_query($params)
        );

        return $request->withHeader('Auth', $this->key);
    }
}