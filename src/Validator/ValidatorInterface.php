<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Validator;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Common interface for ParamsValidator
 */
interface ValidatorInterface
{
    /**
     * Begins validate method params
     * Validates params and throw InvalidArgumentException if some error
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function validate(): void;
}
