<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Modification;

use Rikta\PhpQuery\Exception\IncompatibleModificationException;
use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;
use Rikta\PhpQuery\Utils\PathGetterInterface;

final class OnPathValue implements QueryOperationInterface
{
    use QueryOperationTrait;

    private PathGetterInterface $getter;
    private QueryOperationInterface $operation;

    public function __construct(QueryOperationInterface $operation, PathGetterInterface $getter)
    {
        if (!$operation->isApplicableOnSubValue()) {
            throw new IncompatibleModificationException($this, $operation);
        }
        $this->getter = $getter;
        $this->operation = $operation;
    }

    public function __invoke(array $items): array
    {
        $keys = array_keys(($this->operation)(array_map($this->getter, $items)));

        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $items[$key];
        }

        return $result;
    }

    public function isReducingItems(): bool
    {
        return $this->operation->isReducingItems();
    }
}
