<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\Utils\ValuePath;

class MapToValue extends Map
{
    public function __construct(ValuePath $getter)
    {
        parent::__construct($getter);
    }

    public function isApplicableOnSubValue(): bool
    {
        return true;
    }
}
