<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Utils\PathSegments;

class ArraySegment implements PathSegmentInterface
{
    private $key;
    private string $notation;

    public function __construct(string $notation)
    {
        $this->notation = $notation;
        $this->key = trim($notation, '["\'.]');
    }

    /** {@inheritDoc} */
    public function getFromValue($value)
    {
        return $value[$this->key];
    }

    /** {@inheritDoc} */
    public function getNotation(): string
    {
        return $this->notation;
    }

    /** {@inheritDoc} */
    public function isAccessible($value): bool
    {
        return \array_key_exists($this->key, $value);
    }
}
