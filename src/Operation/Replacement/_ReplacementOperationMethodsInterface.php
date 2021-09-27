<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\QueryInterface;

/**
 * The purpose of the methods in this specific interface is:
 * Replacing values or keys permanently with content of the value.
 *
 * NO operation in this interface is not()-able!
 *
 * Some added operations in this interface work on paths (sub-values) and MUST BE called behind a `$query->onNextPath(...)`
 * the corresponding sub-value is provided to the operation (e.g. `$query->not()->onNextPath('.id')->mapToKey()`)
 * - mapToKey()
 * - mapToValue()
 *
 * @internal this interface shall only be used to build the QueryInterface and not be implemented on it's own in any class!
 *           The methods are scattered into different interfaces&traits to group the operation methods thematically for easier understanding
 */
interface _ReplacementOperationMethodsInterface
{
    /**
     * replaces the key with the subvalue of the currently set path.
     *
     * MUST BE called behind a `$query->onNextPath(...)`, e.g. `$query->not()->onNextPath('.id')->mapToKey()`
     */
    public function mapToKey(): QueryInterface;

    /**
     * replaces the value with the subvalue of the currently set path.
     *
     * MUST BE called behind a `$query->onNextPath(...)`, e.g. `$query->not()->onNextPath('.title')->mapToValue()`
     */
    public function mapToValue(): QueryInterface;

    /** replaces the value with the result of a passed callable. */
    public function mapToValueFn(callable $mapFn): QueryInterface;

    /**
     * replaces the value with a flat associative array containing only the values from specific paths.
     *
     * @example
     * $query->multiMap([
     *   'name' => '.name',
     *   'email' => '.contact.email',
     *   'phone' => '.contact.phone->normalized()'
     * ])
     */
    public function multiMap(array $mapping): QueryInterface;
}
