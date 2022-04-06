<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\Introductory;
use Mycom\Tracker\S2S\Api\Common\PaymentState;
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
            if (
                $this->params->paymentState != PaymentState::RECEIVED
                && $this->params->paymentState != PaymentState::TRIAL
            ) {
                throw new InvalidArgumentException("paymentState must be RECEIVED or TRIAL");
            }
        }

        if ($this->params->isIntroductory !== null) {
            if (
                $this->params->isIntroductory != Introductory::INTRODUCTORY
                && $this->params->isIntroductory != Introductory::REGULAR
            ) {
                throw new InvalidArgumentException("isIntroductory must be REGULAR or INTRODUCTORY");
            }
        }
    }
}
