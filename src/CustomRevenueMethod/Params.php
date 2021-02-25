<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents custom event params
 */
final class Params extends BaseParams
{
    /** @var string|null */
    public ?string $idTransaction = null;

    /** @var string|null */
    public ?string $currency = null;

    /** @var float|null */
    public ?float $total = null;
}
