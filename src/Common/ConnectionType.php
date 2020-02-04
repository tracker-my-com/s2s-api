<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * ConnectionType constants
 */
final class ConnectionType
{
    /** @var int Connection type is unknown */
    const UNKNOWN = 0;

    /** @var int Mobile internet */
    const MOBILE = 1;

    /** @var int Wi-fi */
    const WIFI = 2;

    /** @var int Default connection type */
    const DEFAULT = self::UNKNOWN;
}
