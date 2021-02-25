<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;


/**
 * Base implementation for BaseParamsInterface
 */
class BaseParams
{
    /** @var int|null */
    public ?int $eventTimestamp = null;

    /** @var string|null */
    public ?string $customUserId = null;

    /** @var string|null */
    public ?string $ipv4 = null;

    /** @var string|null */
    public ?string $ipv6 = null;

    /** @var int|null */
    public ?int $idGender = null;

    /** @var int|null */
    public ?int $age = null;

    /** @var int|null */
    public ?int $connectionType = null;

    /** @var int|null */
    public ?int $bluetoothEnabled = null;

    /** @var string|null */
    public ?string $instanceId = null;

    /** @var string|null */
    public ?string $idfa = null;

    /** @var string|null */
    public ?string $iosVendorId = null;

    /** @var string|null */
    public ?string $gaid = null;

    /** @var string|null */
    public ?string $androidId = null;

    /** @var int|null */
    public ?int $adTrackingEnabled = null;

    /** @var string|null */
    public ?string $lvid = null;

    /** @var int|null */
    public ?int $adBlocker = null;

    /** @var string|null */
    public ?string $userAgent = null;

    /**
     * Unset all object properties
     *
     * @return void
     */
    public function reset(): void
    {
        foreach ($this as $propertyName => $propertyValue) {
            $this->$propertyName = null;
        }
    }

    /**
     * Get all params as assoc array
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this as $propertyName => $propertyValue) {
            if (null !== $propertyValue) {
                $result[$propertyName] = $propertyValue;
            }
        }

        return $result;
    }
}
