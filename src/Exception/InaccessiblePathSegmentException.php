<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Exception;

use OutOfBoundsException;

class InaccessiblePathSegmentException extends OutOfBoundsException implements QueryRuntimeException
{
    public function __construct($segment, $value, $path, $lvl)
    {
        [$type, $key] = $segment;
        switch ($type) {
            case 'method': $key = "->{$key}()"; break;
            case 'property': $key = "->{$key}"; break;
            case 'array': $key = "[{$key}]"; break;
        }

        /* @noinspection JsonEncodingApiUsageInspection */
        parent::__construct(sprintf(
            'Cannot access `%s` (Level %d of Path `%s`) on `%s` (%s)',
            $key,
            $lvl,
            $path,
            $value,
            json_encode($value, \JSON_PARTIAL_OUTPUT_ON_ERROR),
        ));
    }
}
