<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation;

/**
 * @template Key
 * @template Item
 */
interface QueryOperationInterface
{
    /**
     * Performs the operation on the passed array.
     *
     * @param array<Key, Item> $items
     *
     * @return array<Key, Item>
     */
    public function __invoke(array $items): array;

    /** is the operation applicable on keys, e.g. after an array_flip? */
    public function isApplicableOnKeys(): bool;

    /** is the operation applicable on a sub-value? */
    public function isApplicableOnSubValue(): bool;

    /** is the operation intended to reduce the amount of items */
    public function isReducingItems(): bool;
}
