<?php

declare(strict_types=1);

namespace Imdhemy\Acme;

final class Calculator
{
    public function calculate(string $expression): string
    {
        // WARNING: Don't use eval() in production code!
        return (string)eval('return '.$expression.';');
    }
}
