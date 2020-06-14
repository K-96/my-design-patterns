<?php

#region Import
use DesignPatterns\AbstractFactory\CommunicatorInterface;
use DesignPatterns\AbstractFactory\Communicators\Json\Communicator as JsonCommunicator;
use DesignPatterns\AbstractFactory\Communicators\Xml\Communicator as XmlCommunicator;
use DesignPatterns\AbstractFactory\Communicators\Tsv\Communicator as TsvCommunicator;
use DesignPatterns\AbstractFactory\ContentErrorInterface;
use DesignPatterns\AbstractFactory\ParserErrorInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
#endregion

/**
 * @param RequestInterface $request
 * @param ResponseInterface $response
 * @param CommunicatorInterface $communicator
 * @return ResponseInterface
 *
 * @throws ContentErrorInterface
 * @throws RuntimeException
 */
function clientCode(
    RequestInterface $request,
    ResponseInterface $response,
    CommunicatorInterface $communicator
): ResponseInterface
{
    $cRequest = $communicator->createRequest()->adept($request);
    $cResponse = $communicator->createResponse()->adept($response);
    $parser = $communicator->createParser();

    try {
        $result = domainLogic($parser->decode($cRequest->extractContent()));

        $cResponse->setContent($parser->encode($result));
    } catch (ParserErrorInterface $e) {
        throw new RuntimeException($e->getMessage(), 500, $e);
    }

    return $cResponse->getResponse();
}

function domainLogic(array $data): array
{
    // some domain logic
    return ['name' => $data['name'] ?? 'not found name from request'];
}

/** @var RequestInterface $request */
$request = ServerRequestFactory::fromGlobals();
/** @var ResponseInterface $response */
$response = new Response();

try {
    switch ($request->getHeader('content-type')) {
        case 'application/json':
            $communicator = new JsonCommunicator();
            break;
        case 'application/xml':
            $communicator = new XmlCommunicator();
            throw new RuntimeException('This format is temporarily not supported.', 400);
        case 'text/tab-separated-values':
            $communicator = new TsvCommunicator();
            throw new RuntimeException('This format is temporarily not supported.', 400);
        default:
            throw new RuntimeException('Unknown data format.', 404);
    }

    $response = clientCode($request, $response, $communicator);
    $response->withStatus(200);
} catch (RuntimeException $e) {
    $response->withStatus($e->getCode());
    $response->withHeader('X-Error-Message', $e->getMessage());
} catch (Throwable $e) {
    $response->withStatus(500);
    $response->withHeader('X-Error-Message', 'Internal server error.');
}

(new SapiEmitter())->emit($response);
