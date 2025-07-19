<?php

declare(strict_types=1);

namespace Tests;

use Imdhemy\Acme\Greet;
use PHPUnit\Framework\TestCase;

final class GreetTest extends TestCase
{
    public function test_greet_with_name(): void
    {
        $sut = new Greet();

        $actual = $sut->greet('Ahmed');

        $this->assertSame('Hello, Ahmed!', $actual);
    }
}
