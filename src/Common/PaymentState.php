<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * PaymentState constants
 */
final class PaymentState
{
    /** @var int payment is received */
    public const RECEIVED = 1;

    /** @var int payment is trial */
    public const TRIAL = 2;
}
