<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents custom event params
 */
final class Params extends BaseParams implements ParamsInterface
{
    /** @var string|null */
    protected ?string $customEventName = null;

    /** @var string[]|null */
    protected ?array $customEventParams = null;

    /** @inheritDoc */
    public function setCustomEventName(string $name): self
    {
        $this->customEventName = $name;

        return $this;
    }

    /** @inheritDoc */
    public function getCustomEventName(): ?string
    {
        return $this->customEventName;
    }

    /** @inheritDoc */
    public function setCustomEventParams(array $params): self
    {
        $this->customEventParams = null;
        foreach ($params as $name => $value) {
            $this->addCustomEventParam((string)$name, (string)$value);
        }

        return $this;
    }

    /** @inheritDoc */
    public function addCustomEventParam(string $name, string $value): self
    {
        if (isset($this->customEventParams)) {
            $this->customEventParams[$name] = $value;
        } else {
            $this->customEventParams = [$name => $value];
        }

        return $this;
    }


    /** @inheritDoc */
    public function getCustomEventParams(): ?array
    {
        return $this->customEventParams;
    }
}
