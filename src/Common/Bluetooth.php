<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * Bluetooth statuses constants
 */
final class Bluetooth
{
    /** @var int Bluetooth status is unknown */
    public const UNKNOWN = 0;

    /** @var int Bluetooth is enabled */
    public const ENABLED = 1;

    /** @var int Bluetooth is disabled */
    public const DISABLED = 2;

    /** @var int Default bluetooth status */
    public const DEFAULT = self::UNKNOWN;
}
