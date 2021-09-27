<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Tests\_TestHelper;

use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\QueryInterface;

interface BookQueryExample
{
    public function executeQuery(QueryInterface $query, BookDataRepository $data): array;

    public function expectedResult(): array;
}
