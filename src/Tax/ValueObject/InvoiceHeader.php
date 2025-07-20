<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax\ValueObject;

use JsonSerializable;

final readonly class InvoiceHeader implements JsonSerializable
{
    public function __construct(
        public string $transactionDate,
        public int $poNumber,
        public float $totalTax,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'TRNS_DATE' => $this->transactionDate,
            'PO_NUMBER' => $this->poNumber,
            'TOTAL_TAX' => $this->totalTax,
        ];
    }
}
