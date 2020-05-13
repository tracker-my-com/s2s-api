<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomEventMethod;

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
     * Validate is customEventName was set and not empty.
     *
     * @throws InvalidArgumentException
     */
    public function validateCustomEventNameRequired()
    {
        $customEventName = $this->params->getCustomEventName();
        if (is_null($customEventName) || 0 == strlen($customEventName)) {
            throw new InvalidArgumentException('customEventName param is required');
        }
    }
}
