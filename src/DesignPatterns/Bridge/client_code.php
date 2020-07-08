<?php  /** @noinspection PhpHierarchyChecksInspection */

use DesignPatterns\Bridge\Client;
use DesignPatterns\Bridge\Gateway\Telegram;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class SomePsrHttpRequestFactory implements RequestFactoryInterface {}
class SomePsrHttpClient implements ClientInterface {}

$client = new Client(new Telegram('api_key', new SomePsrHttpClient(), new SomePsrHttpRequestFactory()));
clientCode($client);

function clientCode(Client $client): void {
    $chatId = '123';

    $client->sendMessage($chatId, 'Отчет');
    $client->sendFile($chatId, new SplFileInfo('/tmp/report.xslx'));
}