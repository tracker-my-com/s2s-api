<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\Introductory;
use Mycom\Tracker\S2S\Api\Common\Trial;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

/**
 * Class param validator for AppStoreSubscriptionTransactionMethod
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
     * Validate params for ios payments
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        $params = [
            'transactionId' => $this->params->transactionId,
            'productId' => $this->params->productId,
            'price' => $this->params->price,
            'currency' => $this->params->currency,
            'transactionIdOriginal' => $this->params->transactionIdOriginal
        ];

        foreach ($params as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if ($this->params->price <= 0) {
            throw new InvalidArgumentException("price must be positive number");
        }

        if (strlen($this->params->currency) !== 3) {
            throw new InvalidArgumentException("currency must be 3 character code");
        }

        if ($this->params->isTrial !== null) {
            if (
                $this->params->isTrial != Trial::COMMON
                && $this->params->isTrial != Trial::TRIAL
            ) {
                throw new InvalidArgumentException("isTrial must be COMMON or TRIAL");
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

        $positivValueParams = [
            'tsPaymentOriginal' => $this->params->tsPaymentOriginal,
            'tsPaymentExpires' => $this->params->tsPaymentExpires,
            'quantity' => $this->params->quantity
        ];

        foreach ($positivValueParams as $paramName => $paramValue) {
            if ($paramValue !== null && $paramValue <= 0) {
                throw new InvalidArgumentException("$paramName must be positive number");
            }
        }
    }
}
