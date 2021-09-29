<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;
use Rikta\ValuePath\ValuePath;

class MapToKey implements QueryOperationInterface
{
    use QueryOperationTrait;

    private ValuePath $getter;

    public function __construct(ValuePath $getter)
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
