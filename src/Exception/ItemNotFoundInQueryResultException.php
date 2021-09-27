<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Exception;

use OutOfBoundsException;

class ItemNotFoundInQueryResultException extends OutOfBoundsException implements QueryRuntimeException
{
    public function __construct($index)
    {
        parent::__construct('Item %s not found in QueryResult', $index);
    }
}
