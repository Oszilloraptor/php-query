<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Juggling;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;

/**
 * @template Key
 * @template Item
 * @template-implements Operation<Key, Item>
 */
class Limit implements QueryOperationInterface
{
    use QueryOperationTrait;

    private int $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    /** {@inheritDoc} */
    public function __invoke(array $items): array
    {
        return \array_slice($items, 0, $this->limit, true);
    }

    public function isReducingItems(): bool
    {
        return true;
    }
}
