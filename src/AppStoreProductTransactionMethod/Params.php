<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\AppStoreProductTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents AppStoreProductTransactionMethod method params
 */
final class Params extends BaseParams
{
    /**
     * Transaction identifier
     *
     * @var string|null
     */
    public ?string $transactionId = null;

    /**
     * The purchased product identifier
     *
     * @var string|null
     */
    public ?string $productId = null;

    /**
     * Price of the product
     *
     * @var float|null
     */
    public ?float $price = null;

    /**
     * Payment currency
     *
     * @var string|null
     */
    public ?string $currency = null;

    /**
     * The number of products purchased
     *
     * @var int|null
     */
    public ?int $quantity = null;
}
