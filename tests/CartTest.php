<?php

declare(strict_types=1);

namespace Tests;

use Imdhemy\Acme\Cart;
use Imdhemy\Acme\FailedRemovingFromEmptyCart;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;


// Bool
// assertTrue, // assertFalse
// assertSame, // assertEquals
// assertNotNull, // assertNull
final class CartTest extends TestCase
{
    #[Test]
    public function cart_is_initially_empty(): void
    {
        $sut = new Cart();

        $actual = $sut->isEmpty();

        $this->assertTrue($actual, 'Cart should be empty initially');
        $this->assertSame(0, $sut->getItemCount(), 'Cart should have 0 items initially');
        $this->assertNull($sut->getOwner());
    }

    #[Test]
    public function cart_is_not_empty_after_adding_an_item(): void
    {
        $sut = new Cart();

        $sut->addItem('item1');

        $this->assertFalse($sut->isEmpty(), 'Cart should not be empty after adding an item');
        $this->assertSame(1, $sut->getItemCount(), 'Cart should have 1 item after adding one');
    }

    #[Test]
    public function remove_item_from_empty_cart_should_fail(): void
    {
        $this->expectException(FailedRemovingFromEmptyCart::class);
        $this->expectExceptionMessage('Cannot remove item from an empty cart.');

        $sut = new Cart();

        $sut->removeItem('item1');
    }

    #[Test]
    public function set_owner(): void
    {
        $sut = new Cart([], 'John Doe');

        $this->assertNotNull($sut->getOwner(), 'Cart owner should not be null');
    }
}
