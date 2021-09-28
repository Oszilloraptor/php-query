<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Utils;

use Rikta\PhpQuery\Exception\InaccessiblePathSegmentException;
use Rikta\PhpQuery\Utils\PathSegments\ArraySegment;
use Rikta\PhpQuery\Utils\PathSegments\MethodSegment;
use Rikta\PhpQuery\Utils\PathSegments\PathSegmentInterface;
use Rikta\PhpQuery\Utils\PathSegments\PropertySegment;

/**
 * Allows traversing array/objects with simple paths.
 *
 * it supports arrays and methods with constant arguments
 * a getter-function is generated on construction and the object itself invokable
 *
 * @example
 * [0]->getData('phones')['work']->number->toString()
 * or (equivalent, just more convenient syntax for arrays):
 * .0->getData('phones').work->number->toString()
 *
 * @template Item of array<string|int, mixed>|ArrayAccess<string|int, mixed>|object
 * @template Result
 *
 * @internal this class may be extracted to another package anytime
 *
 * @todo extract into dedicated package
 */
final class PathGetter implements PathGetterInterface
{
    private $getFn;
    private string $path;

    public function __construct(string $path)
    {
        if (trim($path) === '') {
            $this->getFn = static fn ($value) => $value;
        } else {
            $this->path = $path;
            $segments = $this->parseString($this->path);
            $this->getFn = $this->generateRecursiveGetFn($segments);
        }
    }

    /**
     * The PathGetter is a callable with constructor, therefore you can just call any instance,
     * e.g. $value =$pathGetter('.something').
     *
     * @param mixed $item
     */
    public function __invoke($item)
    {
        return ($this->getFn)($item);
    }

    /** parses a segment into an array with [$type, $name, $args]. */
    private function createSegment(string $segment): PathSegmentInterface
    {
        if (str_ends_with($segment, ']') || str_starts_with($segment, '.')) {
            return new ArraySegment($segment);
        }

        if (str_ends_with($segment, ')')) {
            return new MethodSegment($segment);
        }

        return new PropertySegment($segment);
    }

    /** Generates the function for that specific segment. */
    private function generateGetFn(PathSegmentInterface $segment): ?callable
    {
        return static fn ($value) => $segment->isAccessible($value) ? $segment->getFromValue($value) : $this->inaccessiblePathSegment($segment, $value);
    }

    /** Recursively generates the function. */
    private function generateRecursiveGetFn(array $segments, ?callable $carry = null)
    {
        $getFn = $this->generateGetFn(array_shift($segments));

        if (null === $carry) {
            $carry = $getFn;
        } else {
            $carry = fn ($value) => ($this->getFn)($carry($value));
        }

        return empty($segments) ? $carry : $this->generateRecursiveGetFn($segments, $carry);
    }

    /**
     * handle inaccessible path segments.
     *
     * @noinspection PhpReturnDocTypeMismatchInspection
     * @todo: add handling that returns null or a default or sth...
     *
     * @param mixed $value
     *
     * @return mixed to prevent type-hint-errors when chaining the method
     */
    private function inaccessiblePathSegment(PathSegmentInterface $segment, $value)
    {
        throw new InaccessiblePathSegmentException($segment, $value, $this->path);
    }

    /** parses a string into an array of segments. */
    private function parseString(string $path): array
    {
        $matches = [];
        preg_match_all('/(?:\[|->|\.)[^]\-)]+[])]?/m', $path, $matches);

        return array_map([$this, 'createSegment'], $matches[0]);
    }
}
