<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

final class RequestFactory
{
    public function createInvoiceRequest(
        CreateInvoicePayload $payload,
        string $taxNumber,
        string $username
    ): RequestInterface {
        return new Request('POST', 'api/invoices');
    }
}
