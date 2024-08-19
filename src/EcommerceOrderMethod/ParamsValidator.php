<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

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
     * Validate params for an ecommerce order
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        $requireParams = [
            'order_id' => $this->params->orderId,
        ];

        foreach ($requireParams as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if (strlen($this->params->currencyCode) !== 3) {
            throw new InvalidArgumentException("currency_code must be a 3-letter alphabetic code");
        }

        if (!is_numeric($this->params->actionTs)) {
            throw new InvalidArgumentException("action_ts must be a valid numeric timestamp");
        }

        if (empty($this->params->items)) {
            throw new InvalidArgumentException("items array must contain at least one product item");
        }

        foreach ($this->params->items as $item) {
            $itemParamsValidator = new ProductItemParamsValidator($item);
            $itemParamsValidator->validate();
        }
    }

    private function validateProductItem($item): void
    {
        $requireParams = [
            'item_id' => $item->itemId,
            'item_name' => $item->itemName,
            'price' => $item->price,
            'quantity' => $item->quantity,
        ];

        foreach ($requireParams as $paramName => $paramValue) {
            if ($paramValue === null || $paramValue === '') {
                throw new InvalidArgumentException("$paramName param is required");
            }
        }

        if ($item->price < 0 || $item->price > 10_000_000_000) {
            throw new InvalidArgumentException("price must be between 0 and 10,000,000,000");
        }

        if ($item->discount < 0 || $item->discount > 10_000_000_000) {
            throw new InvalidArgumentException("discount must be between 0 and 10,000,000,000");
        }

        if ($item->tax < 0 || $item->tax > 100) {
            throw new InvalidArgumentException("tax must be between 0 and 100");
        }

        if ($item->index < 0) {
            throw new InvalidArgumentException("index must be a non-negative integer");
        }

        if ($item->quantity < 1 || $item->quantity > 10_000_000_000) {
            throw new InvalidArgumentException("quantity must be between 1 and 10,000,000,000");
        }
    }
}
