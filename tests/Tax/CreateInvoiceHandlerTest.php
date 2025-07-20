<?php

declare(strict_types=1);

namespace Tests\Tax;

use Imdhemy\Acme\Tax\CreateInvoiceFailedException;
use Imdhemy\Acme\Tax\CreateInvoiceHandler;
use Imdhemy\Acme\Tax\CreateInvoicePayload;
use Imdhemy\Acme\Tax\RequestFactory;
use Imdhemy\Acme\Tax\ValueObject\Credential;
use Imdhemy\Acme\Tax\ValueObject\Invoice;
use Imdhemy\Acme\Tax\ValueObject\InvoiceHeader;
use Imdhemy\Acme\Tax\ValueObject\InvoiceLineItem;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final class CreateInvoiceHandlerTest extends TestCase
{
    #[Test]
    public function create_invoice(): void
    {
        $credential = new Credential('username', 'password', 'taxNumber');
        $invoiceHeader = new InvoiceHeader('2025-05-23', 20250523001, 190);
        $invoiceLineItem = new InvoiceLineItem(
            serviceMain: 1,
            serviceTypeCode: 'serviceTypeCode',
            productName: 'productName',
            quantity: 1,
            serviceValue: 100.0,
            vatAmount: 18.0,
            vatPercent: 18.0,
            discount: 0.0
        );
        $invoice = new Invoice($invoiceHeader, [$invoiceLineItem]);
        $payload = new CreateInvoicePayload($credential, $invoice);
        $client = $this->createMock(ClientInterface::class);
        $requestFactory = new RequestFactory();
        $sut = new CreateInvoiceHandler($client, $requestFactory);

        $sut->handle($payload);

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

        $credential = new Credential('username', 'password', 'taxNumber');
        $invoiceHeader = new InvoiceHeader('2025-05-23', 20250523001, 190);
        $invoiceLineItem = new InvoiceLineItem(
            serviceMain: 1,
            serviceTypeCode: 'serviceTypeCode',
            productName: 'productName',
            quantity: 1,
            serviceValue: 100.0,
            vatAmount: 18.0,
            vatPercent: 18.0,
            discount: 0.0
        );
        $invoice = new Invoice($invoiceHeader, [$invoiceLineItem]);
        $payload = new CreateInvoicePayload($credential, $invoice);

        $sut->handle($payload);
    }
}
