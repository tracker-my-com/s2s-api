<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents custom event params
 */
final class Params extends BaseParams
{
    /** @var string|null */
    public ?string $customEventName = null;

    /** @var string[]|null */
    public ?array $customEventParams = null;
}
