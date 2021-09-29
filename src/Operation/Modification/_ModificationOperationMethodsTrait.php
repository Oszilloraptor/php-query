<?php

/** @noinspection PhpIncompatibleReturnTypeInspection */

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Modification;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\QueryInterface;
use Rikta\ValuePath\ValuePath;
use Rikta\ValuePath\ValuePathInterface;

/**
 * The purpose of the methods in this specific trait is:
 * Wrapping the subsequent operation and modifying its input and or result.
 *
 * @internal this trait shall only be used to build the Query-class and not be used on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 *
 * @see _ModificationOperationMethodsInterface
 */
trait _ModificationOperationMethodsTrait
{
    private bool $flipNext = false;

    /** @var array<string, ValuePathInterface> caching-array of getters */
    private array $getters = [];

    /** @var bool shall the next operation be negated? */
    private bool $negateNext = false;

    /** @var string|null path of the value for the next operation, should only be used on single path-dependant operations */
    private ?string $nextPath = null;

    /**
     * {@inheritDoc}
     *
     * @see _ModificationOperationMethodsInterface::flip()
     */
    public function flip(): QueryInterface
    {
        $this->flipNext = true;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @see _ModificationOperationMethodsInterface::not()
     */
    public function not(): QueryInterface
    {
        $this->negateNext = true;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @see _ModificationOperationMethodsInterface::onPathValue()
     */
    public function onPathValue(string $path): QueryInterface
    {
        $this->nextPath = $path;

        return $this;
    }

    protected function applyModification(QueryOperationInterface $operation): QueryOperationInterface
    {
        if ($this->flipNext) {
            $operation = new Flip($operation);
            $this->flipNext = false;
        }

        if ($this->negateNext) {
            $operation = new Not($operation);
            $this->negateNext = false;
        }

        if (null !== $this->nextPath) {
            $operation = new OnPathValue($operation, $this->nextGetter());
            $this->nextPath = null;
        }

        return $operation;
    }

    protected function getGetter(string $path): ValuePathInterface
    {
        return $this->getters[$path] ??= new ValuePath($path);
    }

    protected function nextGetter(): ValuePathInterface
    {
        $getter = $this->getGetter($this->nextPath);
        $this->nextPath = null;

        return $getter;
    }
}
