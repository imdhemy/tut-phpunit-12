<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use function json_decode;

final readonly class AuthMiddleware
{
    public function __construct(private ClientInterface $client)
    {
    }

    public function __invoke(RequestInterface $request): RequestInterface
    {
        $taxNumber = $request->getHeaderLine('X-tax-number');
        $username = $request->getHeaderLine('X-username');
        $password = $request->getHeaderLine('X-password');

        return $request->withHeader('Authorization', $this->fetchAuthHeader($taxNumber, $username, $password));
    }

    private function fetchAuthHeader(string $taxNumber, string $username, string $password): string
    {
        $request = new Request(
            'GET',
            "https://portal.smart-code.app/sc/workspace/security/token?taxNumber={$taxNumber}&username={$username}&password={$password}"
        );
        $response = $this->client->sendRequest($request);
        $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return 'Bearer '.$body['data'];
    }
}
