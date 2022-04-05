<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

/**
 * Class param validator for GooglePlayProductTransactionMethod
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
            'productId' => $this->params->productId,
            'token' => $this->params->token,
            'currency' => $this->params->currency,
            'revenue' => $this->params->revenue
        ];

        foreach ($params as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if (strlen($this->params->currency) !== 3) {
            throw new InvalidArgumentException("currency must be 3 character code");
        }

        if ($this->params->revenue <= 0.0) {
            throw new InvalidArgumentException("revenue must be positive number");
        }
    }
}
