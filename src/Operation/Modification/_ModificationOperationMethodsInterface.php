<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Modification;

use Rikta\PhpQuery\QueryInterface;

/**
 * The purpose of the methods in this specific interface is:
 * Wrapping the subsequent operation and modifying its input and or result.
 *
 * @internal this interface shall only be used to build the QueryInterface and not be implemented on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 */
interface _ModificationOperationMethodsInterface
{
    /**
     * array_flips the items for the subsequent operation.
     * Keys become values, values become keys.
     *
     * The items are flipped back after the operation.
     *
     * Not all operations are flippable!
     */
    public function flip(): QueryInterface;

    /**
     * Remove the returned items of the subsequent call from the query.
     *
     * @example
     * $repo = new ArrayRepository([1, 2, 3, 4]);
     * $query = Query::forRepository($repo);
     * $filter = fn ($value) => $value % 2;
     * $query->filterValues($filter)->getResults()->getItems(); // [1, 3]
     * $query->not()->filterValues($filter)->getResults()->getItems(); // [2, 4]
     *
     * Only operations that actually (try to) reduce items are not-able!
     * Calling it e.g. on a sort - wouldn't it throw an exception - would essentially discarding all items.
     */
    public function not(): QueryInterface;

    /**
     * Perform the next operation on a subvalue.
     *
     * instead of the original item the corresponding sub-value is provided to your check (e.g. `$query->not()->onNextPath('.something')->isEmpty()`)
     * the result of the operation is the set of original items (= not only the sub-values), minus any items which sub-values didn't pass the check
     */
    public function onPathValue(string $path): QueryInterface;
}
