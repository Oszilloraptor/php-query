<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;

/**
 * @template Key
 * @template Item
 * @template-implements QueryOperationInterface<Key, Item>
 */
class Filter implements QueryOperationInterface
{
    use QueryOperationTrait;

    /** @var callable */
    private $filterFn;

    public function __construct(callable $filterFn)
    {
        $this->filterFn = $filterFn;
    }

    /** {@inheritDoc} */
    public function __invoke(array $items): array
    {
        return array_filter($items, $this->filterFn, \ARRAY_FILTER_USE_BOTH);
    }

    public function isApplicableOnKeys(): bool
    {
        return true;
    }

    public function isApplicableOnSubValue(): bool
    {
        return true;
    }

    public function isReducingItems(): bool
    {
        return true;
    }
}
