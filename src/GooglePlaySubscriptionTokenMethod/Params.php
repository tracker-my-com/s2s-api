<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents GooglePlaySubscriptionToken method params
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
     * The purchased subscription identifier
     *
     * @var string|null
     */
    public ?string $subscriptionId = null;

    /**
     * The token provided to the user's device when the product was purchased
     *
     * @var string|null
     */
    public ?string $token = null;

    /**
     * Subscription period in ISO 8601 format, for example:
     * P1W — one week
     * P1M — one month
     *
     * @var string|null
     */
    public ?string $subscriptionPeriod = null;
}
