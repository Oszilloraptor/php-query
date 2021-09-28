<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Exception;

use OutOfBoundsException;
use Rikta\PhpQuery\Utils\PathSegments\PathSegmentInterface;

class InaccessiblePathSegmentException extends OutOfBoundsException implements QueryRuntimeException
{
    public function __construct(PathSegmentInterface $segment, $value, $path)
    {
        /* @noinspection JsonEncodingApiUsageInspection */
        parent::__construct(sprintf(
            'Cannot access `%s` (of Path `%s`) on `%s` (%s)',
            $segment->getNotation(),
            $path,
            $value,
            json_encode($value, \JSON_PARTIAL_OUTPUT_ON_ERROR),
        ));
    }
}
