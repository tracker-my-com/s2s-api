<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod;

use DateInterval;
use Exception;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

/**
 * Class param validator for GooglePlaySubscriptionTokenMethod
 */
final class ParamsValidator implements ValidatorInterface
{
    /** @var Params */
    protected Params $params;

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
     * Validate params for googlePlay payments
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        $params = [
            'orderId' => $this->params->orderId,
            'subscriptionId' => $this->params->subscriptionId,
            'token' => $this->params->token
        ];

        foreach ($params as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if ($this->params->subscriptionPeriod !== null) {
            try {
                new DateInterval($this->params->subscriptionPeriod);
            } catch (Exception $e) {
                throw new InvalidArgumentException("subscriptionPeriod param should be in ISO 8601 format");
            }
        }
    }
}
