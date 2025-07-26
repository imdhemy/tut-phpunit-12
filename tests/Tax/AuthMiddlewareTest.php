<?php

declare(strict_types=1);

namespace Tests\Tax;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Imdhemy\Acme\Tax\AuthMiddleware;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use function json_encode;

final class AuthMiddlewareTest extends TestCase
{
    #[Test]
    public function it_should_add_authorization_header(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $responseBody = [
            'data' => 'some-token',
            'message' => 'Success generating token',
        ];
        $client->method('sendRequest')->willReturn(new Response(body: json_encode($responseBody, JSON_THROW_ON_ERROR)));
        $request = new Request('GET', 'https://example.com', [
            'X-username' => 'testuser',
            'X-password' => 'testpass',
            'X-tax-number' => '1234567890',
        ]);
        $sut = new AuthMiddleware($client);

        $actual = $sut($request);

        $this->assertSame($actual->getHeaderLine('Authorization'), 'Bearer some-token');
    }
}
