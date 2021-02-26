<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * ConnectionType constants
 */
final class ConnectionType
{
    /** @var int Connection type is unknown */
    public const UNKNOWN = 0;

    /** @var int Mobile internet */
    public const MOBILE = 1;

    /** @var int Wi-fi */
    public const WIFI = 2;

    /** @var int Default connection type */
    public const DEFAULT = self::UNKNOWN;
}
