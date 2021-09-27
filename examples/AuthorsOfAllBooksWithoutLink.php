<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Examples;

use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\QueryInterface;
use Rikta\PhpQuery\Tests\_TestHelper\BookQueryExample;

/**
 * Returns authors of all all books that don't have a link associated with them.
 */
class AuthorsOfAllBooksWithoutLink implements BookQueryExample
{
    public function executeQuery(QueryInterface $query, BookDataRepository $data): array
    {
        return $query
            ->onPathValue('.link')->isEmpty()
            ->onPathValue('.author')->mapToValue()
            ->getResultsFor($data)
            ->getItems()
        ;
    }

    public function expectedResult(): array
    {
        return ['Paul Celan', 'Giacomo Leopardi'];
    }
}
