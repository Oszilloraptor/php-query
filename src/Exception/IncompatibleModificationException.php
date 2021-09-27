<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Exception;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use UnexpectedValueException;

class IncompatibleModificationException extends UnexpectedValueException implements QueryRuntimeException
{
    public function __construct(QueryOperationInterface $modification, QueryOperationInterface $operation)
    {
        parent::__construct(sprintf('Cannot perform %s on %s', \get_class($modification), \get_class($operation)));
    }
}
