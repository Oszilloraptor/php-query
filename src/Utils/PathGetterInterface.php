<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Utils;

/**
 * Allows traversing array/objects with simple paths.
 *
 * it supports arrays and methods with constant arguments
 * a getter-function is generated on construction and the object itself invokable
 *
 * @example
 * [0]->getData('phones')['work']->number->toString()
 * or (equivalent, just more convenient syntax for arrays):
 * .0->getData('phones').work->number->toString()
 *
 * @template Item of array<string|int, mixed>|ArrayAccess<string|int, mixed>|object
 * @template Result
 *
 * @internal this interface may be extracted to another package anytime
 *
 * @todo extract into dedicated package
 */
interface PathGetterInterface
{
    /**
     * @param Item $item
     *
     * @return Result
     */
    public function __invoke($item);
}
