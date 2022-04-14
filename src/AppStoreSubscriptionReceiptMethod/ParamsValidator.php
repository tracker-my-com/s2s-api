<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\AppStoreSubscriptionReceiptMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

/**
 * Class param validator for AppStoreSubscriptionReceiptMethod
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
            'receipt' => $this->params->receipt,
            'price' => $this->params->price,
            'currency' => $this->params->currency,
        ];

        foreach ($params as $paramName => $paramValue) {
            if (empty($paramValue)) {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if ($this->params->price <= 0) {
            throw new InvalidArgumentException("price must be positive number");
        }

        if (strlen($this->params->currency) !== 3) {
            throw new InvalidArgumentException("currency must be 3 character code");
        }

        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $this->params->receipt)) {
            throw new InvalidArgumentException("receipt must be valid base64 string");
        }
    }
}
