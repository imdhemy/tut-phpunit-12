<?php

declare(strict_types=1);

namespace Imdhemy\Acme\Tax\ValueObject;

final readonly class Credential
{
    public function __construct(
        public string $username,
        public string $password,
        public string $taxNumber,
    ) {
    }
}
