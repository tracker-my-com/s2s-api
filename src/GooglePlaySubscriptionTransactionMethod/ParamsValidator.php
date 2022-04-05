<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

/**
 * Class param validator for GooglePlaySubscriptionTransactionMethod
 */
final class ParamsValidator implements ValidatorInterface
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
     * Validate params for googlePlay payments
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        $params = [
            'orderId' => $this->params->orderId,
            'priceCurrencyCode' => $this->params->priceCurrencyCode,
            'priceAmountMicros' => $this->params->priceAmountMicros,
            'subscriptionId' => $this->params->subscriptionId,
        ];

        foreach ($params as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if (strlen($this->params->priceCurrencyCode) !== 3) {
            throw new InvalidArgumentException("priceCurrencyCode must be 3 character code");
        }

        if ($this->params->priceAmountMicros <= 0) {
            throw new InvalidArgumentException("priceAmountMicros must be positive number");
        }

        if ($this->params->paymentState !== null) {
            if (!is_numeric($this->params->paymentState)) {
                throw new InvalidArgumentException("paymentState must be string with number");
            }

            $paymentState = intval($this->params->paymentState);
            if ($paymentState != 1 && $paymentState != 2) {
                throw new InvalidArgumentException("paymentState must be 1 or 2");
            }
        }

        if (!empty($this->params->isIntroductory)) {
            if ($this->params->isIntroductory != 0 && $this->params->isIntroductory != 1) {
                throw new InvalidArgumentException("isIntroductory must be 0 or 1");
            }
        }
    }
}
