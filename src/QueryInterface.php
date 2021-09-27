<?php

declare(strict_types=1);

namespace Rikta\PhpQuery;

use Rikta\PhpQuery\Operation\Filter\_FilterOperationMethodsInterface;
use Rikta\PhpQuery\Operation\Juggling\_JugglingOperationMethodsInterface;
use Rikta\PhpQuery\Operation\Modification\_ModificationOperationMethodsInterface;
use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\Replacement\_ReplacementOperationMethodsInterface;
use Rikta\PhpQuery\Result\QueryResultInterface;
use Rikta\Repository\RepositoryInterface;
use Rikta\TimedLoop\LoopTimeoutException;

interface QueryInterface extends _FilterOperationMethodsInterface,       // is*, filter, inArray, comparisons, ...
    _JugglingOperationMethodsInterface,     // sort, limit, reverse, ...
    _ModificationOperationMethodsInterface, // not, flip, onNextPath ...
    _ReplacementOperationMethodsInterface   // mapToValue, mapToKey, multiMap, ...
{
    /** Adds an operation that shall be performed when results are gathered. */
    public function addOperation(QueryOperationInterface $operation): self;

    /**
     * Returns items after applying previously added operations.
     *
     * @param array|RepositoryInterface $repository
     *
     * @return QueryResultInterface<mixed, mixed>
     */
    public function getResultsFor($repository): QueryResultInterface;

    /**
     * Waits until $minItems are matching the query for $repository.
     *
     * @throws LoopTimeoutException if $maxSeconds have passed without returning a result
     */
    public function wait(RepositoryInterface $repository, int $minItems = 1, int $maxSeconds = 10, int $retryAfterMicroseconds = 5_000): self;
}
