<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents custom event params
 */
final class Params extends BaseParams
{
    /**
     * Set custom event name.
     * We can split stats by event names.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/events
     *
     * @var string|null Custom event name
     */
    public ?string $customEventName = null;

    /**
     * Set additional custom event params if needed.
     * We can split stats by these values.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/events
     *
     * @var string[]|null Custom params hash in form [name => value]
     */
    public ?array $customEventParams = null;

}
