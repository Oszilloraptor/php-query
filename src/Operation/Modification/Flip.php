<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Modification;

use Rikta\PhpQuery\Exception\IncompatibleModificationException;
use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;

class Flip implements QueryOperationInterface
{
    use QueryOperationTrait;
    private QueryOperationInterface $operation;

    public function __construct(QueryOperationInterface $operation)
    {
        if (!$operation->isApplicableOnKeys()) {
            throw new IncompatibleModificationException($this, $operation);
        }
        $this->operation = $operation;
    }

    public function __invoke(array $items): array
    {
        return array_flip(($this->operation)(array_flip($items)));
    }
}
