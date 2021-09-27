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
class Reverse implements QueryOperationInterface
{
    use QueryOperationTrait;

    /** {@inheritDoc} */
    public function __invoke(array $items): array
    {
        return array_reverse($items);
    }
}
