<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Examples;

use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\QueryInterface;
use Rikta\PhpQuery\Tests\_TestHelper\BookQueryExample;

/**
 * Returns all books that don't have a link associated with them.
 */
class ThreeBiggestEnglishBooksAndTheirAuthorsAfter1900AndAlphabeticallySorted implements BookQueryExample
{
    public function executeQuery(QueryInterface $query, BookDataRepository $data): array
    {
        return $query
            ->onPathValue('.year')->greaterThanOrEqual(1900)
            ->onPathValue('.language')->identical('English')
            ->onPathValue('.pages')->sort(static fn ($a, $b) => -($a <=> $b))
            ->limit(3)
            ->onPathValue('.title')->mapToKey()
            ->onPathValue('.author')->mapToValue()
            ->sort()
            ->getResultsFor($data)
            ->toArray()
        ;
    }

    public function expectedResult(): array
    {
        return [
            'The Golden Notebook' => 'Doris Lessing',
            'Tales' => 'Edgar Allan Poe',
            'Invisible Man' => 'Ralph Ellison',
        ];
    }
}
