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
class Sort implements QueryOperationInterface
{
    use QueryOperationTrait;

    /** @var callable */
    private $sortFn;

    public function __construct(?callable $sortFn = null)
    {
        $this->sortFn = $sortFn ?? static fn ($a, $b) => $a <=> $b;
    }

    /** {@inheritDoc} */
    public function __invoke(array $items): array
    {
        uasort($items, $this->sortFn);

        return $items;
    }

    public function isApplicableOnKeys(): bool
    {
        return true;
    }

    public function isApplicableOnSubValue(): bool
    {
        return true;
    }
}
