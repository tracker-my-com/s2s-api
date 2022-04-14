<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\AppStoreSubscriptionReceiptMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents AppStoreSubscriptionReceiptMethod method params
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
     * Payment receipt in base64 format
     *
     * @var string|null
     */
    public ?string $receipt = null;

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
     * Payment receipt in gz format
     *
     * @var string|null
     */
    public ?string $receipt_gz = null;
}
