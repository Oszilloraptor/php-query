<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Examples;

use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\QueryInterface;
use Rikta\PhpQuery\Tests\_TestHelper\BookQueryExample;

/**
 * Returns all books that don't have a link associated with them.
 */
class BooksWithoutLink implements BookQueryExample
{
    public function executeQuery(QueryInterface $query, BookDataRepository $data): array
    {
        return $query
            ->onPathValue('.link')->isEmpty()
            ->getResultsFor($data)
            ->toArray()
        ;
    }

    public function expectedResult(): array
    {
        return [
            14 => [
                'author' => 'Paul Celan',
                'country' => 'Romania, France',
                'language' => 'German',
                'link' => '',
                'pages' => 320,
                'title' => 'Poems',
                'year' => 1952,
            ],
            55 => [
                'author' => 'Giacomo Leopardi',
                'country' => 'Italy',
                'language' => 'Italian',
                'link' => '',
                'pages' => 184,
                'title' => 'Poems',
                'year' => 1818,
            ],
        ];
    }
}
