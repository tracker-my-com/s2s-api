<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * AD tracking statuses constants
 */
final class AdTracking
{
    /** @var int AD tracking is enabled */
    const ENABLED = 1;

    /** @var int AD tracking is disabled */
    const DISABLED = 0;

    /** @var int Default AD tracking status */
    const DEFAULT = self::ENABLED;
}
