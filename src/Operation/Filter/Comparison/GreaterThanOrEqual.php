<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter\Comparison;

use Rikta\PhpQuery\Operation\Filter\Filter;

final class GreaterThanOrEqual extends Filter
{
    public function __construct($b)
    {
        parent::__construct(static fn ($a) => $a >= $b);
    }
}
