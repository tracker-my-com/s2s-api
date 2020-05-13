<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * Bluetooth statuses constants
 */
final class Bluetooth
{
    /** @var int Bluetooth status is unknown */
    const UNKNOWN = 0;

    /** @var int Bluetooth is enabled */
    const ENABLED = 1;

    /** @var int Bluetooth is disabled */
    const DISABLED = 2;

    /** @var int Default bluetooth status */
    const DEFAULT = self::UNKNOWN;
}
