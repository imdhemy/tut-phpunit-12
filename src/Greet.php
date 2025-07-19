<?php

declare(strict_types=1);

namespace Imdhemy\Acme;

final class Greet
{
    public function greet(string $name): string
    {
        return sprintf('Hello, %s!', $name);
    }
}
