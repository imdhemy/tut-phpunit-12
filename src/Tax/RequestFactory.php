<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax;

use GuzzleHttp\Psr7\Request;
use JsonException;
use Psr\Http\Message\RequestInterface;
use function json_encode;

final class RequestFactory
{
    /**
     * @throws JsonException
     */
    public function createInvoiceRequest(CreateInvoicePayload $payload): RequestInterface
    {
        return new Request(
            method: 'POST',
            uri: "https://portal.smart-code.app/sc/workspace/finance/invoices?taxNumber={$payload->credential->taxNumber}&username={$payload->credential->username}",
            headers: [
                'Content-Type' => 'application/json',
                'X-username' => $payload->credential->username,
                'X-password' => $payload->credential->password,
                'X-tax-number' => $payload->credential->taxNumber,
            ],
            body: json_encode($payload, JSON_THROW_ON_ERROR)
        );
    }
}
