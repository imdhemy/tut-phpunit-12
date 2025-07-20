<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final readonly class CreateInvoiceHandler
{
    public function __construct(
        private ClientInterface $client,
        private RequestFactory $requestFactory,
    ) {
    }

    /**
     * @return void - In case of success, the method does not return any value.
     * @throws CreateInvoiceFailedException - if the invoice creation fails.
     */
    public function handle(CreateInvoicePayload $payload): void
    {
        try {
            $request = $this->requestFactory->createInvoiceRequest($payload);

            $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new CreateInvoiceFailedException(previous: $e);
        }
    }
}
