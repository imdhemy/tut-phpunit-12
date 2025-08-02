<?php

declare(strict_types=1);

namespace Tests;

use Imdhemy\Acme\Calculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    public static function provide_data_for_calculate(): array
    {
        return [
            ['1 + 1', '2'],
            ['2 - 1', '1'],
            ['2 * 3', '6'],
            ['6 / 2', '3'],
        ];
    }

    #[Test]
    #[DataProvider('provide_data_for_calculate')]
    #[TestDox('calculate $expression = $expected')]
    public function calculate(string $expression, string $expected): void
    {
        $sut = new Calculator();

        $actual = $sut->calculate($expression);

        $this->assertSame($expected, $actual);
    }
}
