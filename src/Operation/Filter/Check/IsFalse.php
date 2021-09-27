<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Filter\Check;

use Rikta\PhpQuery\Operation\Filter\Filter;

class IsFalse extends Filter
{
    public function __construct()
    {
        parent::__construct(static fn ($a) => false === $a);
    }
}
