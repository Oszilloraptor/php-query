<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation;

trait QueryOperationTrait
{
    /**
     * is the operation applicable on keys, e.g. after an array_flip?
     * Intended to be overwritten (only) by implementations that are actually applicable on keys.
     */
    public function isApplicableOnKeys(): bool
    {
        return false;
    }

    /**
     * is the operation applicable on a sub-value?
     * Intended to be overwritten (only) by implementations that are actually applicable on sub-values.
     */
    public function isApplicableOnSubValue(): bool
    {
        return false;
    }

    /**
     * is the operation intended to reduce the amount of items?
     * Intended to be overwritten (only) by implementations that are actually reducing the amount of items.
     */
    public function isReducingItems(): bool
    {
        return false;
    }
}
