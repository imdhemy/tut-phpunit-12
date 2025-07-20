<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax\ValueObject;

use JsonSerializable;

final readonly class InvoiceLineItem implements JsonSerializable
{
    public function __construct(
        public int $serviceMain,
        public string $serviceTypeCode,
        public string $productName,
        public int $quantity,
        public float $serviceValue,
        public float $vatAmount,
        public float $vatPercent,
        public float $discount,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'SERVICE_MAIN' => $this->serviceMain,
            'SERVICE_TYPE_CODE' => $this->serviceTypeCode,
            'PRODUCT_NAME' => $this->productName,
            'QTY' => $this->quantity,
            'SERVICE_VALUE' => $this->serviceValue,
            'VAT_AMOUNT' => $this->vatAmount,
            'VAT_PERCENT' => $this->vatPercent,
            'DISC' => $this->discount,
        ];
    }
}
