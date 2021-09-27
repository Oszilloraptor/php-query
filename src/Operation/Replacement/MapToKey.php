<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;
use Rikta\PhpQuery\Utils\PathGetter;

class MapToKey implements QueryOperationInterface
{
    use QueryOperationTrait;

    private PathGetter $getter;

    public function __construct(PathGetter $getter)
    {
        $this->getter = $getter;
    }

    public function __invoke(array $items): array
    {
        return array_combine(array_map($this->getter, $items), array_values($items));
    }

    public function isApplicableOnSubValue(): bool
    {
        return true;
    }
}
