<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * Ad blocker statuses constants
 */
final class AdBlocker
{
    /** @var int Ad blocker is enabled */
    public const ENABLED = 1;

    /** @var int Ad blocker is disabled */
    public const DISABLED = 0;

    /** @var int Default Ad blocker status */
    public const DEFAULT = self::DISABLED;
}
