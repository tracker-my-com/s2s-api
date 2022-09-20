<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents GooglePlayProductTransaction method params
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
     * The purchased product identifier
     *
     * @var string|null
     */
    public ?string $productId = null;

    /**
     * The token provided to the user's device when the product was purchased
     *
     * @var string|null
     */
    public ?string $token = null;

    /**
     * Payment currency
     *
     * @var string|null
     */
    public ?string $currency = null;

    /**
     * Payment amount in the specified currency
     *
     * @var float|null
     */
    public ?float $revenue = null;

    /**
     * Is payment verificated by user
     *
     * @var int|null
     */
    public ?int $isVerified = null;
}
