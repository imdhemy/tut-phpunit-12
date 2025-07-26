<?php

declare(strict_types=1);

namespace Tests\Tax;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Imdhemy\Acme\Tax\AuthMiddleware;
use Imdhemy\Acme\Tax\CreateInvoiceHandler;
use Imdhemy\Acme\Tax\CreateInvoicePayload;
use Imdhemy\Acme\Tax\RequestFactory;
use Imdhemy\Acme\Tax\ValueObject\Credential;
use Imdhemy\Acme\Tax\ValueObject\Invoice;
use Imdhemy\Acme\Tax\ValueObject\InvoiceHeader;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

// This a dummy example showing how to use the services in your production code.
final class ClientCodeExampleTest extends TestCase
{
    #[Test]
    public function store(): void
    {
        $handlerStack = HandlerStack::create();
        $authMiddleware = Middleware::mapRequest(new AuthMiddleware(new Client()));
        $handlerStack->push($authMiddleware);

        $client = new Client(['handler' => $handlerStack]);

        $requestFactory = new RequestFactory();
        $handler = new CreateInvoiceHandler($client, $requestFactory);

        $credential = new Credential('', '', '');
        $invoiceHeader = new InvoiceHeader('', 1, 1);

        $invoice = new Invoice($invoiceHeader, []);
        
        $handler->handle(new CreateInvoicePayload($credential, $invoice));
    }
}
