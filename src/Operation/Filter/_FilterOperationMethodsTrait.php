<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter;

use Rikta\PhpQuery\Operation\Filter\Check\IsArray;
use Rikta\PhpQuery\Operation\Filter\Check\IsEmpty;
use Rikta\PhpQuery\Operation\Filter\Check\IsFalse;
use Rikta\PhpQuery\Operation\Filter\Check\IsFalsy;
use Rikta\PhpQuery\Operation\Filter\Check\IsInt;
use Rikta\PhpQuery\Operation\Filter\Check\IsNull;
use Rikta\PhpQuery\Operation\Filter\Check\IsNumeric;
use Rikta\PhpQuery\Operation\Filter\Check\IsObject;
use Rikta\PhpQuery\Operation\Filter\Check\IsScalar;
use Rikta\PhpQuery\Operation\Filter\Check\IsString;
use Rikta\PhpQuery\Operation\Filter\Check\IsTrue;
use Rikta\PhpQuery\Operation\Filter\Check\IsTruthy;
use Rikta\PhpQuery\Operation\Filter\Check\IsValidDirectory;
use Rikta\PhpQuery\Operation\Filter\Check\IsValidFilePath;
use Rikta\PhpQuery\Operation\Filter\Comparison\Equals;
use Rikta\PhpQuery\Operation\Filter\Comparison\GreaterThan;
use Rikta\PhpQuery\Operation\Filter\Comparison\GreaterThanOrEqual;
use Rikta\PhpQuery\Operation\Filter\Comparison\Identical;
use Rikta\PhpQuery\Operation\Filter\Comparison\LessThan;
use Rikta\PhpQuery\Operation\Filter\Comparison\LessThanOrEqual;
use Rikta\PhpQuery\Operation\Filter\Comparison\NotEqual;
use Rikta\PhpQuery\Operation\Filter\Comparison\NotIdentical;
use Rikta\PhpQuery\QueryInterface;

/**
 * The purpose of the methods in this specific trait is:
 * Removing items from the query that dont pass a certain check.
 *
 * All added operations in this interface are `not()`-able, if you call them behind a `$query->not()`
 * all items that pass your check will be actually removed (e.g. `$query->not()->isEmpty()`)
 *
 * All added operations in this trait also work on paths (sub-values), if you call them behind a `$query->onNextPath('.something').
 * instead of the original item the corresponding sub-value is provided to your check (e.g. `$query->not()->onNextPath('.something')->isEmpty()`)
 * the result of the operation is the set of original items (= not only the sub-values), minus any items which sub-values didn't pass the check
 *
 * @internal this trait shall only be used to build the Query-class and not be used on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 *
 * @see _FilterOperationMethodsInterface
 */
trait _FilterOperationMethodsTrait
{
    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::equals()
     */
    public function equals($b): QueryInterface
    {
        return $this->addOperation(new Equals($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::filter()
     */
    public function filter(callable $filterFn): QueryInterface
    {
        return $this->addOperation(new Filter($filterFn));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::greaterThan()
     */
    public function greaterThan($b): QueryInterface
    {
        return $this->addOperation(new GreaterThan($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::greaterThanOrEqual()
     */
    public function greaterThanOrEqual($b): QueryInterface
    {
        return $this->addOperation(new GreaterThanOrEqual($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::identical()
     */
    public function identical($b): QueryInterface
    {
        return $this->addOperation(new Identical($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::inArray()
     */
    public function inArray(array $array): QueryInterface
    {
        return $this->addOperation(new InArray($array));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isArray()
     */
    public function isArray(): QueryInterface
    {
        return $this->addOperation(new IsArray());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isEmpty()
     */
    public function isEmpty(): QueryInterface
    {
        return $this->addOperation(new IsEmpty());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isFalse()
     */
    public function isFalse(): QueryInterface
    {
        return $this->addOperation(new IsFalse());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isFalsy()
     */
    public function isFalsy(): QueryInterface
    {
        return $this->addOperation(new IsFalsy());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isInt()
     */
    public function isInt(): QueryInterface
    {
        return $this->addOperation(new IsInt());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isNull()
     */
    public function isNull(): QueryInterface
    {
        return $this->addOperation(new IsNull());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isNumeric()
     */
    public function isNumeric(): QueryInterface
    {
        return $this->addOperation(new IsNumeric());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isObject()
     */
    public function isObject(): QueryInterface
    {
        return $this->addOperation(new IsObject());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isScalar()
     */
    public function isScalar(): QueryInterface
    {
        return $this->addOperation(new IsScalar());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isString()
     */
    public function isString(): QueryInterface
    {
        return $this->addOperation(new IsString());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isTrue()
     */
    public function isTrue(): QueryInterface
    {
        return $this->addOperation(new IsTrue());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isTruthy()
     */
    public function isTruthy(): QueryInterface
    {
        return $this->addOperation(new IsTruthy());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isValidDirectory()
     */
    public function isValidDirectory(): QueryInterface
    {
        return $this->addOperation(new IsValidDirectory());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::isValidFilePath()
     */
    public function isValidFilePath(): QueryInterface
    {
        return $this->addOperation(new IsValidFilePath());
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::lessThan()
     */
    public function lessThan($b): QueryInterface
    {
        return $this->addOperation(new LessThan($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::lessThanOrEqual()
     */
    public function lessThanOrEqual($b): QueryInterface
    {
        return $this->addOperation(new LessThanOrEqual($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::notEqual()
     */
    public function notEqual($b): QueryInterface
    {
        return $this->addOperation(new NotEqual($b));
    }

    /**
     * {@inheritDoc}
     *
     * @see _FilterOperationMethodsInterface::notIdentical()
     */
    public function notIdentical($b): QueryInterface
    {
        return $this->addOperation(new NotIdentical($b));
    }
}
