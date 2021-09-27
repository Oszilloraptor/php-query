<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Utils;

use Error;
use Rikta\PhpQuery\Exception\InaccessiblePathSegmentException;

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
    private int $lvl;
    private string $path;
    private array $segments;

    public function __construct(string $path)
    {
        if (trim($path) === '') {
            $this->getFn = static fn ($value) => $value;
        } else {
            $this->path = $path;
            $this->segments = $this->parseString($this->path);
            $this->getFn = $this->generateRecursiveGetFn($this->segments);
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
        $this->lvl = 0;

        return ($this->getFn)($item);
    }

    /**
     * Generates the function for that specific segment.
     *
     * @param mixed $type
     */
    private function generateGetFn($type, string $name, ?array $args): ?callable
    {
        switch ($type) {
            case 'array':
                return static fn ($value) => \array_key_exists($name, $value) ? $value[$name] : $this->inaccessiblePathSegment($value);
            case 'method':
                return static fn ($value) => \is_callable($value->{$name}) ? $value->{$name}(...($args ?? [])) : $this->inaccessiblePathSegment($value);
            case 'property':
                return static fn ($value) => property_exists($value, $name) ? $value->{$name} : $this->inaccessiblePathSegment($value);
        }

        throw new Error();
    }

    /** Recursively generates the function. */
    private function generateRecursiveGetFn(array $segments, ?callable $carry = null)
    {
        $getFn = $this->generateGetFn(...array_shift($segments));

        if (null === $carry) {
            $carry = $getFn;
        } else {
            $carry = function ($value) use ($carry) {
                ++$this->lvl;

                return ($this->getFn)($carry($value));
            };
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
    private function inaccessiblePathSegment($value)
    {
        throw new InaccessiblePathSegmentException($this->segments[$this->lvl], $value, $this->path, $this->lvl);
    }

    /** parses a segment into an array with [$type, $name, $args]. */
    private function parseSegment(string $segment): array
    {
        if (str_ends_with($segment, ']') || str_starts_with($segment, '.')) {
            return ['array', trim($segment, '["\'.]'), null];
        }

        if (str_ends_with($segment, ')')) {
            $name = mb_substr($segment, 2, mb_strpos($segment, '(') - 2);
            $argMatches = [];
            preg_match_all('/[\'"](.+)[\'"]/mU', $segment, $argMatches);

            return ['method', $name, $argMatches[1]];
        }

        return ['property', mb_substr($segment, 2), null];
    }

    /** parses a string into an array of segments. */
    private function parseString(string $path): array
    {
        $matches = [];
        preg_match_all('/(?:\[|->|\.)[^]\-)]+[])]?/m', $path, $matches);

        return array_map([$this, 'parseSegment'], $matches[0]);
    }
}
