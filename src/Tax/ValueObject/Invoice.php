<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax\ValueObject;

use JsonSerializable;

final readonly class Invoice implements JsonSerializable
{
    public function __construct(
        public InvoiceHeader $invoiceHeader,
        /** @var InvoiceLineItem[] */
        public array $lineItems = [],
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'invoice_mast' => $this->invoiceHeader,
            'invoice_det' => $this->lineItems,
        ];
    }
}
