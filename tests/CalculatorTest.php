<?php

declare(strict_types=1);

namespace Tests;

use Imdhemy\Acme\Calculator;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    public function test_sum(): void
    {
        $calculator = new Calculator();

        $result = $calculator->sum(2, 3);

        $this->assertSame(5, $result);
    }
}
