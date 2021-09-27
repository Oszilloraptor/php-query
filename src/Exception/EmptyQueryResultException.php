<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Exception;

use OutOfBoundsException;

class EmptyQueryResultException extends OutOfBoundsException implements QueryRuntimeException
{
    public function __construct(string $method)
    {
        parent::__construct(sprintf('Tried to perform Item-dependant method %s on an empty QueryResult', $method));
    }
}
