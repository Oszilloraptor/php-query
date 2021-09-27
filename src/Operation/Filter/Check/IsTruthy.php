<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter\Check;

use Rikta\PhpQuery\Operation\Filter\Filter;

class IsTruthy extends Filter
{
    public function __construct()
    {
        parent::__construct(static fn ($a) => $a);
    }
}
