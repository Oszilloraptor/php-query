<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter;

use Rikta\PhpQuery\QueryInterface;

/**
 * The purpose of the methods in this specific interface is:
 * Removing items from the query that dont pass a certain check.
 *
 * All added operations in this interface are `not()`-able, if you call them behind a `$query->not()`
 * all items that pass your check will be actually removed (e.g. `$query->not()->isEmpty()`)
 *
 * All added operations in this interface work on paths (sub-values), if you call them behind a `$query->onNextPath('.something')
 * instead of the original item the corresponding sub-value is provided to your check (e.g. `$query->not()->onNextPath('.something')->isEmpty()`)
 * the result of the operation is the set of original items (= not only the sub-values), minus any items which sub-values didn't pass the check
 *
 * @internal this interface shall only be used to build the QueryInterface and not be implemented on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 */
interface _FilterOperationMethodsInterface
{
    /**
     * $a == $b.
     *
     * only keeps the item if $a (value) is equal to $b (passed argument) after type juggling.
     *
     * @param mixed $b the value to compare to
     */
    public function equals($b): QueryInterface;

    /**
     * Filters the items of the query with a callable.
     *
     * only keeps the item if $filterFn($item, $key) returns true.
     *
     * @param callable $filterFn callable to call with every item
     *                           first param is the value, the second param the key
     *                           return true to keep the $item, or false to discard it
     */
    public function filter(callable $filterFn): QueryInterface;

    /**
     * $a > $b.
     *
     * only keeps the item if $a (value) is strictly greater than $b (passed argument).
     *
     * @param mixed $b the value to compare to
     */
    public function greaterThan($b): QueryInterface;

    /**
     * $a >= $b.
     *
     * only keeps the item if $a (value) is greater than or equal (passed argument) to $b.
     *
     * @param mixed $b the value to compare to
     */
    public function greaterThanOrEqual($b): QueryInterface;

    /**
     * $a === $b.
     *
     * only keeps the item if $a (value) is equal to $b (passed argument), and they are of the same type.
     *
     * @param mixed $b the value to compare to
     */
    public function identical($b): QueryInterface;

    /**
     * Checks if $value is in $array.
     *
     * only keeps the item if it is in $array
     *
     * @param array $array values to keep
     */
    public function inArray(array $array): QueryInterface;

    /**
     * Checks if the $value is an array.
     *
     * only keeps the item if it is of type `array`
     */
    public function isArray(): QueryInterface;

    /**
     * Checks if the $value is empty.
     *
     * only keeps the item if it is empty
     *
     * A value is considered empty if it equals false after casting it to boolean.
     * (e.g. null, [], false, '', 0)
     */
    public function isEmpty(): QueryInterface;

    /**
     * Checks if the $value is strictly false.
     *
     * only keeps the item if it is `false`
     */
    public function isFalse(): QueryInterface;

    /**
     * Checks if the $value is falsy.
     *
     * only keeps the item if it is falsy
     *
     * A value is considered falsy if value equals false after casting it to a boolean.
     * (e.g. null, [], false, '', 0)
     */
    public function isFalsy(): QueryInterface;

    /**
     * Checks if the $value is an integer.
     *
     * only keeps the item if it is of type `int`
     */
    public function isInt(): QueryInterface;

    /**
     * Checks if the $value is null.
     *
     * only keeps the item if it is null
     */
    public function isNull(): QueryInterface;

    /**
     * Checks if the $value is numeric.
     *
     * only keeps the item if it is a number (int, float) or a numeric string
     */
    public function isNumeric(): QueryInterface;

    /**
     * Checks if the $value is an object.
     *
     * only keeps the item if it is an object.
     */
    public function isObject(): QueryInterface;

    /**
     * Checks if the $value is a scalar value.
     *
     * only keeps the item if it is a scalar value.
     *
     * Scalar variables are those containing an `int`, `float`, `string` or `bool`.
     * The types `array`, `object` and `resource´ are not scalar.
     */
    public function isScalar(): QueryInterface;

    /**
     * Checks if the $value is a string.
     *
     * only keeps the item if it is of type `string`
     */
    public function isString(): QueryInterface;

    /**
     * Checks if the $value is strictly true.
     *
     * only keeps the item if it is `true`
     */
    public function isTrue(): QueryInterface;

    /**
     * Checks if the $value is truthy.
     *
     * only keeps the item if it is truthy
     *
     * A value is considered falsy if value equals true after casting it to a boolean.
     * (e.g. non-null-object, non-empty-array, true, 'non-empty-string', 1)
     */
    public function isTruthy(): QueryInterface;

    /**
     * Checks if the $value is a string containing a valid path to a directory.
     *
     * only keeps the item if it is indeed a valid directory on the current system.
     */
    public function isValidDirectory(): QueryInterface;

    /**
     * Checks if the $value is a string containing a valid path to a file.
     *
     * only keeps the item if it is indeed a valid file-path on the current system.
     */
    public function isValidFilePath(): QueryInterface;

    /**
     * $a < $b.
     *
     * only keeps the item if $a (value) is strictly less than $b (passed argument).
     *
     * @param mixed $b the value to compare to
     */
    public function lessThan($b): self;

    /**
     * $a <= $b.
     *
     * only keeps the item if $a (value) is less than or equal to $b (passed argument).
     *
     * @param mixed $b the value to compare to
     */
    public function lessThanOrEqual($b): self;

    /**
     * $a != $b.
     *
     * only keeps the item if $a (value) is not equal to $b (passed argument) after type juggling.
     *
     * @param mixed $b the value to compare to
     */
    public function notEqual($b): self;

    /**
     * $a !== $b.
     *
     * only keeps the item if $a (value) is not equal to $b (passed argument), or they are not of the same type.
     *
     * @param mixed $b the value to compare to
     */
    public function notIdentical($b): self;
}
