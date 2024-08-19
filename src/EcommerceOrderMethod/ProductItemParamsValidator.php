<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

final class ProductItemParamsValidator implements ValidatorInterface
{
    /** @var ProductItemParams */
    private ProductItemParams $params;

    /**
     * ParamsValidator constructor.
     *
     * @param \Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ProductItemParams $params
     */
    public function __construct(ProductItemParams $params)
    {
        $this->params = $params;
    }

    public function validate(): void
    {
        $requireParams = [
            'item_id' => $this->params->itemId,
            'item_name' => $this->params->itemName,
            'price' => $this->params->price,
            'quantity' => $this->params->quantity,
        ];

        foreach ($requireParams as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if ($this->params->price < 0 || $this->params->price > 10_000_000_000) {
            throw new InvalidArgumentException("price must be between 0 and 10,000,000,000");
        }

        if ($this->params->discount < 0 || $this->params->discount > 10_000_000_000) {
            throw new InvalidArgumentException("discount must be between 0 and 10,000,000,000");
        }

        if ($this->params->tax < 0 || $this->params->tax > 100) {
            throw new InvalidArgumentException("tax must be between 0 and 100");
        }

        if ($this->params->index < 0) {
            throw new InvalidArgumentException("index must be a non-negative integer");
        }

        if ($this->params->quantity < 1 || $this->params->quantity > 10_000_000_000) {
            throw new InvalidArgumentException("quantity must be between 1 and 10,000,000,000");
        }
    }
}
