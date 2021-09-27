<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Exception;

use LengthException;
use Rikta\PhpQuery\Result\QueryResultInterface;

class NotSingleItemException extends LengthException implements QueryRuntimeException
{
    public function __construct(QueryResultInterface $result)
    {
        parent::__construct(sprintf(
            'Expected single item in QueryResult, got %d', $result->getSize(),
        ));
    }
}
