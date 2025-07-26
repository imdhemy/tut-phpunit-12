<?php

declare(strict_types=1);

namespace Imdhemy\Acme;

final class Cart
{
    public function __construct(
        private $items = [],
        private ?string $owner = null,
    ) {
    }

    public function isEmpty(): bool
    {
        return [] === $this->items;
    }

    public function addItem(string $itemId): self
    {
        $this->items[] = $itemId;

        return $this;
    }

    public function getItemCount(): int
    {
        return count($this->items);
    }

    public function removeItem(string $itemId): self
    {
        if ($this->isEmpty()) {
            throw new FailedRemovingFromEmptyCart('Cannot remove item from an empty cart.');
        }

        $this->items = array_filter($this->items, static fn ($item) => $item !== $itemId);

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }
}
