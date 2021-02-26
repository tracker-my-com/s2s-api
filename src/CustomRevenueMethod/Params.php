<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents custom event params
 */
final class Params extends BaseParams
{
    /**
     * Set ID of the transaction in the client's system.
     *
     * @var string|null Transaction identifier, 1-255 characters, example: order1234
     */
    public ?string $idTransaction = null;

    /**
     * Set transaction currency coded in ISO-4217
     *
     * @var string|null Transaction currency, 3 characters, example: USD
     */
    public ?string $currency = null;

    /**
     * Set amount of transaction
     *
     * @var float|null Transaction total, 4-digit precision, example: 1.99
     */
    public ?float $total = null;
}
