<?php

declare(strict_types=1);

namespace Rikta\PhpQuery;

use Rikta\PhpQuery\Operation\Filter\_FilterOperationMethodsTrait;
use Rikta\PhpQuery\Operation\Juggling\_JugglingOperationMethodsTrait;
use Rikta\PhpQuery\Operation\Modification\_ModificationOperationMethodsTrait;
use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\Replacement\_ReplacementOperationMethodsTrait;
use Rikta\PhpQuery\Result\QueryResult;
use Rikta\PhpQuery\Result\QueryResultInterface;
use Rikta\Repository\ArrayRepository;
use Rikta\Repository\RepositoryInterface;
use Rikta\TimedLoop\TimedLoop;

class Query implements QueryInterface
{
    use _FilterOperationMethodsTrait; // is*, filter, inArray, comparisons, ...
    use _JugglingOperationMethodsTrait; // sort, limit, reverse, ...
    use _ModificationOperationMethodsTrait; // not, flip, onNextPath ...
    use _ReplacementOperationMethodsTrait; // mapToValue, mapToKey, multiMap, ...

    /** @var QueryOperationInterface[] operations in chronological order */
    private array $operations = [];

    /** {@inheritDoc} */
    public function addOperation(QueryOperationInterface $operation): self
    {
        $operation = $this->applyModification($operation);
        $this->operations[] = $operation;

        return $this;
    }

    /** {@inheritDoc} */
    public function getResultsFor($repository): QueryResultInterface
    {
        if (\is_array($repository)) {
            $repository = new ArrayRepository($repository);
        }

        $items = $repository->getAllItems();
        $items = $this->applyOperations($items);

        return new QueryResult($items, $this);
    }

    /** {@inheritDoc} */
    public function wait(RepositoryInterface $repository, int $minItems = 1, int $maxSeconds = 10, int $retryAfterMicroseconds = 5_000): QueryInterface
    {
        (new TimedLoop(fn () => $this->getResultsFor($repository)->getSize() >= $minItems))
            ->forMaximumSeconds($maxSeconds)
            ->retryingAfterMicroseconds($retryAfterMicroseconds)
            ->invoke()
        ;

        return $this;
    }

    /** Applies all added operations on an array of items. */
    private function applyOperations(array $items): array
    {
        foreach ($this->operations as $operation) {
            $items = $operation($items);
        }

        return $items;
    }
}
