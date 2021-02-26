<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\Method;

/**
 * Get current api version
 */
final class VersionMethod extends Method
{
    /** @var string response field with version value */
    public const VERSION_FIELD = 'version';

    /** @var string Version command name */
    private const URI = 'version';

    public function __construct()
    {
        parent::__construct(self::URI);
    }
}
