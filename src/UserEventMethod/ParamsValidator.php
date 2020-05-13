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
    private $params;

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
     * Use this validtion for methods that requires customUserId.
     *
     * @throws InvalidArgumentException
     */
    public function validateCustomUserIdRequired()
    {
        $customUserId = $this->params->getCustomUserId();
        if (is_null($customUserId) || 0 == strlen($customUserId)) {
            throw new InvalidArgumentException('customUserId param is required');
        }
    }
}
