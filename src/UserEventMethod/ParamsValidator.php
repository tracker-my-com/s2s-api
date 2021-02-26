<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\UserEventMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Class ParamsValidator
 */
final class ParamsValidator
{
    /** @var Params */
    private Params $params;

    /**
     * ParamsValidator constructor.
     *
     * @param Params $params
     */
    public function __construct(Params $params)
    {
        $this->params = $params;
    }

    /**
     * Validate is customUserId was set and not empty.
     * Use this validation for methods that require customUserId.
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        if (
            $this->params->customUserId === null
            || $this->params->customUserId === ''
        ) {
            throw new InvalidArgumentException('customUserId param is required');
        }
    }
}
