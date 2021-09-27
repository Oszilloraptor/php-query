<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Result;

use JsonException;
use Rikta\PhpQuery\Exception\NotSingleItemException;
use Rikta\PhpQuery\Query;
use Rikta\PhpQuery\QueryInterface;

/**
 * @template Key
 * @template Item
 * @template-implements QueryResultInterface<Key, Item>
 */
class QueryResult implements QueryResultInterface
{
    /** @var array<Key, Item> */
    private array $items;
    private Query $query;

    /** @param array<Key, Item> $items */
    public function __construct(array $items, QueryInterface $query)
    {
        $this->items = array_filter($items, static fn ($item) => null !== $item);
        $this->query = clone $query;
    }

    /** @throws JsonException */
    public function __toString(): string
    {
        return json_encode($this->items, \JSON_THROW_ON_ERROR);
    }

    /** {@inheritDoc} */
    public function getFirstItem()
    {
        return $this->getItemAtOffset(0);
    }

    /** {@inheritDoc} */
    public function getItem($key)
    {
        return $this->items[$key];
    }

    /** {@inheritDoc} */
    public function getItemAtOffset(int $n)
    {
        return array_values($this->items)[$n];
    }

    /** {@inheritDoc} */
    public function getItems(): array
    {
        return array_values($this->items);
    }

    /** {@inheritDoc} */
    public function getKeys(): array
    {
        return array_keys($this->items);
    }

    /** {@inheritDoc} */
    public function getLastItem()
    {
        return $this->getNthItem($this->getSize());
    }

    /** {@inheritDoc} */
    public function getNthItem(int $n)
    {
        return $this->getItemAtOffset($n - 1);
    }

    /** {@inheritDoc} */
    public function getOnlyItem()
    {
        $this->assertIsExactlyOneItem();

        return $this->getFirstItem();
    }

    /** {@inheritDoc} */
    public function getOnlyKey()
    {
        $this->assertIsExactlyOneItem();

        return $this->getKeys()[0];
    }

    /** {@inheritDoc} */
    public function getQuery(): QueryInterface
    {
        return clone $this->query;
    }

    /** {@inheritDoc} */
    public function getSize(): int
    {
        return \count($this->items);
    }

    /** {@inheritDoc} */
    public function isEmpty(): bool
    {
        return 0 !== $this->getSize();
    }

    /** {@inheritDoc} */
    public function toArray(): array
    {
        return $this->items;
    }

    private function assertIsExactlyOneItem(): void
    {
        if (!($this->getSize() !== 1)) {
            throw new NotSingleItemException($this);
        }
    }
}
