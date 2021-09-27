<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Juggling;

use Rikta\PhpQuery\QueryInterface;

/**
 * The purpose of the methods in this specific trait is:
 * Perform operations that work across the whole query, like sorting or limiting.
 *
 * Some added operations in this trait are `not()`-able, if you call them behind a `$query->not()`
 * all items that pass your check will be actually removed (e.g. `$query->not()->unique()`)
 * - limit()
 * - unique()
 *
 * Some added operations in this trait work on paths (sub-values), if you call them behind a `$query->onNextPath('.something')
 * instead of the original item the corresponding sub-value is provided to your check (e.g. `$query->not()->onNextPath('.something')->unique()`)
 * the result of the operation is the set of original items (= not only the sub-values), minus any items which sub-values didn't pass the check
 * - sort()
 * - unique()
 *
 * @internal this trait shall only be used to build the Query-class and not be used on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 *
 * @see _JugglingOperationMethodsInterface
 */
trait _JugglingOperationMethodsTrait
{
    /**
     * {@inheritDoc}
     *
     * @see _JugglingOperationMethodsInterface::limit()
     */
    public function limit(int $n): QueryInterface
    {
        return $this->addOperation(new Limit($n));
    }

    /**
     * {@inheritDoc}
     *
     * @see _JugglingOperationMethodsInterface::reverse()
     */
    public function reverse(): QueryInterface
    {
        return $this->addOperation(new Reverse());
    }

    /**
     * {@inheritDoc}
     *
     * @see _JugglingOperationMethodsInterface::sort()
     */
    public function sort(?callable $sortFn = null): QueryInterface
    {
        return $this->addOperation(new Sort($sortFn));
    }

    /**
     * {@inheritDoc}
     *
     * @see _JugglingOperationMethodsInterface::unique()
     */
    public function unique(): QueryInterface
    {
        return $this->addOperation(new Unique());
    }
}
