<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\QueryInterface;
use Rikta\PhpQuery\Utils\PathGetter;

/**
 * @internal this trait shall only be used to build the Query-class and not be used on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 *
 * @see _ReplacementOperationMethodsInterface
 */
trait _ReplacementOperationMethodsTrait
{
    /**
     * {@inheritDoc}
     *
     * @see _ReplacementOperationMethodsInterface::mapToKey()
     */
    public function mapToKey(): QueryInterface
    {
        return $this->addOperation(new MapToKey($this->nextGetter()));
    }

    /**
     * {@inheritDoc}
     *
     * @see _ReplacementOperationMethodsInterface::mapToValue()
     */
    public function mapToValue(): QueryInterface
    {
        return $this->addOperation(new MapToValue($this->nextGetter()));
    }

    /**
     * {@inheritDoc}
     *
     * @see _ReplacementOperationMethodsInterface::mapToValueFn()
     */
    public function mapToValueFn(callable $mapFn): QueryInterface
    {
        return $this->addOperation(new Map($mapFn));
    }

    /**
     * {@inheritDoc}
     *
     * @see _ReplacementOperationMethodsInterface::multiMap()
     */
    public function multiMap(array $mapping): QueryInterface
    {
        return $this->addOperation(new MultiMap(array_map(fn ($path) => $this->getter[$path] ??= new PathGetter($path), $mapping)));
    }
}
