<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Operation\Replacement;

use Rikta\PhpQuery\Operation\QueryOperationInterface;
use Rikta\PhpQuery\Operation\QueryOperationTrait;
use Rikta\PhpQuery\Utils\PathGetter;

class MultiMap implements QueryOperationInterface
{
    use QueryOperationTrait;

    /** @var array<string, PathGetter> */
    private array $mapping;

    /**
     * MultiMap constructor.
     *
     * @param array<string, PathGetter> $mapping
     */
    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    public function __invoke(array $items): array
    {
        $mapping = $this->mapping;

        return array_map(static function ($value) use ($mapping): array {
            $result = [];
            foreach ($mapping as $key => $getter) {
                $result[$key] = $getter($value);
            }

            return $result;
        }, $items);
    }
}
