<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter;

class InArray extends Filter
{
    public function __construct(array $items)
    {
        parent::__construct(static fn ($item) => \in_array($item, $items, true));
    }
}
