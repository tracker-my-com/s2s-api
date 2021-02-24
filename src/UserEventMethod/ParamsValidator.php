<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\UserEventMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Class ParamsValidator
 */
final class ParamsValidator
{
    /** @var ParamsInterface */
    private ParamsInterface $params;

    /**
     * ParamsValidator constructor.
     *
     * @param ParamsInterface $params
     */
    public function __construct(ParamsInterface $params)
    {
        $this->params = $params;
    }

    /**
     * Validate is customUserId was set and not empty.
     * Use this validation for methods that requires customUserId.
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        $customUserId = $this->params->getCustomUserId();
        if ($customUserId === null || $customUserId === '') {
            throw new InvalidArgumentException('customUserId param is required');
        }
    }
}
