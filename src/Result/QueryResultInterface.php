<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Result;

use Rikta\PhpQuery\Exception\EmptyQueryResultException;
use Rikta\PhpQuery\Exception\ItemNotFoundInQueryResultException;
use Rikta\PhpQuery\Exception\NotSingleItemException;
use Rikta\PhpQuery\QueryInterface;

/**
 * @template Key
 * @template Item
 */
interface QueryResultInterface
{
    /** Returns a string-representation of $this->data. */
    public function __toString(): string;

    /**
     * Returns the first item.
     *
     * @throws EmptyQueryResultException if the QueryResult is empty
     *
     * @return Item
     */
    public function getFirstItem();

    /**
     * Returns the item with key $key.
     *
     * @param Key $key
     *
     * @throws ItemNotFoundInQueryResultException if there is no Item at with key $key
     * @throws EmptyQueryResultException          if the QueryResult is empty
     *
     * @return Item
     */
    public function getItem($key);

    /**
     * Returns the element at the numeric $offset of the QueryResult (starts at 0).
     *
     * @throws ItemNotFoundInQueryResultException if there is no Item at with key $key
     * @throws EmptyQueryResultException          if the QueryResult is empty
     *
     * @return Item
     */
    public function getItemAtOffset(int $offset);

    /**
     * Returns items as iterative array.
     *
     * @return Item[]
     */
    public function getItems(): array;

    /**
     * Returns the keys.
     *
     * @return Key[]
     */
    public function getKeys(): array;

    /**
     * Returns the last item.
     *
     * @throws ItemNotFoundInQueryResultException if there is no item
     *
     * @return Item
     */
    public function getLastItem();

    /**
     * Returns the item at the $nth position of the QueryResult (starts at 1).
     *
     * @throws ItemNotFoundInQueryResultException if there is no Item at with key $key
     * @throws EmptyQueryResultException          if the QueryResult is empty
     *
     * @return Item
     */
    public function getNthItem(int $n);

    /**
     * Returns the only item. Throws an exception if there is not exactly one.
     *
     * @throws EmptyQueryResultException if the QueryResult is empty
     * @throws NotSingleItemException    if there is more than one item
     *
     * @return Item
     */
    public function getOnlyItem();

    /**
     * Returns the key of the only item. Throws an exception if there is not exactly one.
     *
     * @throws EmptyQueryResultException if the QueryResult is empty
     * @throws NotSingleItemException    if there is more than one item
     *
     * @return Key
     */
    public function getOnlyKey();

    /**
     * Creates a clone of the query that lead to this result. (fresh clone on each call).
     *
     * @return QueryInterface<Key, Item>
     */
    public function getQuery(): QueryInterface;

    /** Returns the amount of items. */
    public function getSize(): int;

    /** Returns true if there are no items. */
    public function isEmpty(): bool;

    /**
     * Returns an array-representation of the data.
     *
     * @return array<Key, Item>
     */
    public function toArray(): array;
}
