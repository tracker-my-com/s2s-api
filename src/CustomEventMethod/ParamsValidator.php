<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomEventMethod;

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
     * Validate is customEventName was set and not empty.
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        if (
            $this->params->customEventName === null
            || $this->params->customEventName === ''
        ) {
            throw new InvalidArgumentException('customEventName param is required');
        }

        if ($this->params->customEventParams !== null) {
            foreach ($this->params->customEventParams as $name => $value) {
                if (!\is_string($name)) {
                    throw new InvalidArgumentException('customEventParams key name must be a string');
                }
                if (!\is_string($value)) {
                    throw new InvalidArgumentException('customEventParams key value must be a string');
                }
            }
        }
    }
}
