<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Modification;

use Rikta\PhpQuery\Exception\IncompatibleModificationException;
use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;

final class Not implements QueryOperationInterface
{
    use QueryOperationTrait;

    private QueryOperationInterface $operation;

    public function __construct(QueryOperationInterface $operation)
    {
        if (!$operation->isReducingItems()) {
            throw new IncompatibleModificationException($this, $operation);
        }

        $this->operation = $operation;
    }

    public function __invoke(array $items): array
    {
        $keys = array_diff(array_keys($items), array_keys(($this->operation)($items)));

        return array_filter($items, static fn ($key) => \in_array($key, $keys, true), \ARRAY_FILTER_USE_KEY);
    }

    public function isApplicableOnKeys(): bool
    {
        return $this->operation->isApplicableOnKeys();
    }

    public function isApplicableOnSubValue(): bool
    {
        return $this->operation->isApplicableOnSubValue();
    }
}
