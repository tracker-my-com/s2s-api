<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends BaseInvalidArgumentException implements ExceptionInterface
{
}
