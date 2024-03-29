<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;
use Mycom\Tracker\S2S\Api\Common\Introductory;
use Mycom\Tracker\S2S\Api\Common\PaymentState;

/**
 * Represents GooglePlaySubscriptionTransaction method params
 */
final class Params extends BaseParams
{
    /**
     * Transaction identifier
     *
     * @var string|null
     */
    public ?string $orderId = null;

    /**
     * Payment currency
     *
     * @var string|null
     */
    public ?string $priceCurrencyCode = null;

    /**
     * Price of the subscription expressed in micro-units
     * where 1,000,000 micro-units represents one unit of the currency.
     * For example, if the subscription price is €1.99, priceAmountMicros is 1990000.
     *
     * @var int|null
     */
    public ?int $priceAmountMicros = null;

    /**
     * The purchased subscription identifier
     *
     * @var string|null
     */
    public ?string $subscriptionId = null;

    /**
     * The payment state of the subscription:
     *
     * @see PaymentState for payment values.
     * @var int|null
     */
    public ?int $paymentState = null;

    /**
     * Introductory price information of the subscription:
     *
     * @see Introductory for introductory values.
     * @var int|null
     */
    public ?int $isIntroductory = null;

    /**
     * Time at which the subscription was granted, in milliseconds
     *
     * @var int|null
     */
    public ?int $startTimeMillis = null;

    /**
     * Time at which the subscription will expire (after this transaction), in milliseconds
     *
     * @var int|null
     */
    public ?int $expiryTimeMillis = null;
}
