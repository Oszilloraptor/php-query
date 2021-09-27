<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Juggling;

use Rikta\PhpQuery\QueryInterface;

/**
 * The purpose of the methods in this specific interface is:
 * Perform operations that work across the whole query, like sorting or limiting.
 *
 * Some added operations in this interface are `not()`-able, if you call them behind a `$query->not()`
 * all items that pass your check will be actually removed (e.g. `$query->not()->unique()`)
 * - limit()
 * - unique()
 *
 * Some added operations in this interface work on paths (sub-values), if you call them behind a `$query->onNextPath('.something')
 * instead of the original item the corresponding sub-value is provided to your check (e.g. `$query->not()->onNextPath('.something')->unique()`)
 * the result of the operation is the set of original items (= not only the sub-values), minus any items which sub-values didn't pass the check
 * - sort()
 * - unique()
 *
 * @internal this interface shall only be used to build the QueryInterface and not be implemented on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 */
interface _JugglingOperationMethodsInterface
{
    /** limits the query to its first $n elements. */
    public function limit(int $n): QueryInterface;

    /** reverses the order of the items. */
    public function reverse(): QueryInterface;

    /** sorts the items in ascending order - or by the provided sort-fn. */
    public function sort(?callable $sortFn = null): QueryInterface;

    /** removes all duplicate items; preserving only the first occurrence */
    public function unique(): QueryInterface;
}
