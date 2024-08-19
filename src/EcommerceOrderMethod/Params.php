<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents EcommerceOrderMethod method params
 */
final class Params extends BaseParams
{
    /**
     * Unique identifier of the order
     *
     * @var string|null
     */
    public ?string $orderId = null;

    /**
     * Status of the order (case insensitive)
     *
     * @var string|null
     */
    public ?string $status = null;

    /**
     * Currency code of the order
     *
     * @var string|null
     */
    public ?string $currencyCode = null;

    /**
     * Identifier for the action performed
     *
     * @var string|null
     */
    public ?string $actionId = null;

    /**
     * Timestamp of the action performed
     *
     * @var string|null
     */
    public ?string $actionTs = null;

    /**
     * Coupon code applied to the order
     *
     * @var string|null
     */
    public ?string $coupon = null;

    /**
     * Array of product items in the order
     *
     * @var ProductItemParams[]|null
     */
    public ?array $items = null;
}
