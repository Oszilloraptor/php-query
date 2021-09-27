<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;

class Map implements QueryOperationInterface
{
    use QueryOperationTrait;

    private $mapFn;

    public function __construct(callable $mapFn)
    {
        $this->mapFn = $mapFn;
    }

    public function __invoke(array $items): array
    {
        return array_map($this->mapFn, $items);
    }

    public function isApplicableOnSubValue(): bool
    {
        return false;
    }
}
