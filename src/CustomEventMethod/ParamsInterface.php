<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParamsInterface;

/**
 * Represents custom event params
 */
interface ParamsInterface extends BaseParamsInterface
{
    /**
     * Set custom event name.
     * We can split statistics by event names.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/events
     * @see setCustomEventParams
     *
     * @param string $name Custom event name
     *
     * @return $this
     */
    public function setCustomEventName(string $name): self;

    /**
     * Get current custom event name value
     *
     * @return string|null
     */
    public function getCustomEventName(): ?string;

    /**
     * Set additional custom event params if you want.
     * We can split statistics by that values.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/events
     *
     * @param array $params Custom params hash in form [name => value]
     *
     * @return $this
     */
    public function setCustomEventParams(array $params): self;

    /**
     * Set additional custom event param if you want.
     * We can split statistics by that values.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/events
     * @see setCustomEventParams
     *
     * @param string $name  Custom event param name
     * @param string $value Custom event param value
     *
     * @return $this
     */
    public function addCustomEventParam(string $name, string $value): self;

    /**
     * Get current custom event params value
     *
     * @return string[]|null
     */
    public function getCustomEventParams(): ?array;
}
