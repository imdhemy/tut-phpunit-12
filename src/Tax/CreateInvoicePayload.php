<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax;

use Imdhemy\Acme\Tax\ValueObject\Credential;
use Imdhemy\Acme\Tax\ValueObject\Invoice;
use JsonSerializable;

final readonly class CreateInvoicePayload implements JsonSerializable
{
    public function __construct(
        public Credential $credential,
        public Invoice $invoice,
    ) {
    }

    public function jsonSerialize(): Invoice
    {
        return $this->invoice;
    }
}
