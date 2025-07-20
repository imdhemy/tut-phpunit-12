<?php

declare(strict_types=1);

namespace Tests\Tax;

use Imdhemy\Acme\Tax\CreateInvoiceFailedException;
use Imdhemy\Acme\Tax\CreateInvoiceHandler;
use Imdhemy\Acme\Tax\CreateInvoicePayload;
use Imdhemy\Acme\Tax\RequestFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final class CreateInvoiceHandlerTest extends TestCase
{
    #[Test]
    public function create_invoice(): void
    {
        $username = 'testuser';
        $taxNumber = '123456789';
        $payload = new CreateInvoicePayload();
        $client = $this->createMock(ClientInterface::class);
        $requestFactory = new RequestFactory();
        $sut = new CreateInvoiceHandler($client, $requestFactory);

        $sut->handle($payload, $taxNumber, $username);

        $this->expectNotToPerformAssertions();
    }

    #[Test]
    public function create_invoice_failure(): void
    {
        $this->expectException(CreateInvoiceFailedException::class);

        $client = $this->createMock(ClientInterface::class);
        $clientException = $this->createMock(ClientExceptionInterface::class);
        $client->method('sendRequest')->willThrowException($clientException);
        $requestFactory = new RequestFactory();
        $sut = new CreateInvoiceHandler($client, $requestFactory);

        $sut->handle(new CreateInvoicePayload(), '1234567', 'testuser');
    }
}
