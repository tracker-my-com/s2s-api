<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents AppStoreSubscriptionTransactionMethod method params
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
     * Original transaction identifier (the first transaction in the subscription).
     *
     * @var string|null
     */
    public ?string $transactionIdOriginal = null;

    /**
     * Trial subscription
     *
     * @see Trial
     * @var int|null
     */
    public ?int $isTrial = null;

    /**
     * Introductory price information of the subscription:
     *
     * @see Introductory for introductory values.
     * @var int|null
     */
    public ?int $isIntroductory = null;

    /**
     * Time at which the subscription was granted
     *
     * @var int|null
     */
    public ?int $tsPaymentOriginal = null;

    /**
     * Time at which the subscription will expire
     *
     * @var int|null
     */
    public ?int $tsPaymentExpires = null;

    /**
     * The number of products purchased
     *
     * @var int|null
     */
    public ?int $quantity = null;
}
