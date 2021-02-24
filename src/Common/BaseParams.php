<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;


/**
 * Base implementation for BaseParamsInterface
 */
class BaseParams implements BaseParamsInterface
{
    /** @var int|null */
    protected ?int $eventTimestamp = null;

    /** @var string|null */
    protected ?string $customUserId = null;

    /** @var string|null */
    protected ?string $ipv4 = null;

    /** @var string|null */
    protected ?string $ipv6 = null;

    /** @var int|null */
    protected ?int $idGender = null;

    /** @var int|null */
    protected ?int $age = null;

    /** @var int|null */
    protected ?int $connectionType = null;

    /** @var int|null */
    protected ?int $bluetoothEnabled = null;

    /** @var string|null */
    protected ?string $instanceId = null;

    /** @var string|null */
    protected ?string $idfa = null;

    /** @var string|null */
    protected ?string $iosVendorId = null;

    /** @var string|null */
    protected ?string $gaid = null;

    /** @var string|null */
    protected ?string $androidId = null;

    /** @var int|null */
    protected ?int $adTrackingEnabled = null;

    /** @var string|null */
    protected ?string $lvid = null;

    /** @var int|null */
    protected ?int $adBlocker = null;

    /** @var string|null */
    protected ?string $userAgent = null;

    /**  @inheritDoc */
    public function setEventTimestamp(int $ts): self
    {
        $this->eventTimestamp = $ts;

        return $this;
    }

    /** @inheritDoc */
    public function getEventTimestamp(): ?int
    {
        return $this->eventTimestamp;
    }

    /**  @inheritDoc */
    public function setCustomUserId(string $userId): self
    {
        $this->customUserId = $userId;

        return $this;
    }

    /** @inheritDoc */
    public function getCustomUserId(): ?string
    {
        return $this->customUserId;
    }

    /**  @inheritDoc */
    public function setIpv4(string $ipv4): self
    {
        $this->ipv4 = $ipv4;

        return $this;
    }

    /** @inheritDoc */
    public function getIpv4(): ?string
    {
        return $this->ipv4;
    }

    /**  @inheritDoc */
    public function setIpv6(string $ipv6): self
    {
        $this->ipv6 = $ipv6;

        return $this;
    }

    /** @inheritDoc */
    public function getIpv6(): ?string
    {
        return $this->ipv6;
    }

    /**  @inheritDoc */
    public function setIdGender(int $idGender = Gender::UNKNOWN): self
    {
        $this->idGender = $idGender;

        return $this;
    }

    /** @inheritDoc */
    public function getIdGender(): ?int
    {
        return $this->idGender;
    }

    /**  @inheritDoc */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /** @inheritDoc */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**  @inheritDoc */
    public function setConnectionType(int $connectionType = ConnectionType::DEFAULT): self
    {
        $this->connectionType = $connectionType;

        return $this;
    }

    /** @inheritDoc */
    public function getConnectionType(): ?int
    {
        return $this->connectionType;
    }

    /**  @inheritDoc */
    public function setBluetoothEnabled(int $bluetoothStatus = Bluetooth::DEFAULT): self
    {
        $this->bluetoothEnabled = $bluetoothStatus;

        return $this;
    }

    /** @inheritDoc */
    public function getBluetoothEnabled(): ?int
    {
        return $this->bluetoothEnabled;
    }

    /** @inheritDoc */
    public function setInstanceId(string $instanceId): self
    {
        $this->instanceId = $instanceId;

        return $this;
    }

    /** @inheritDoc */
    public function getInstanceId(): ?string
    {
        return $this->instanceId;
    }


    /** @inheritDoc */
    public function setIdfa(string $idfa): self
    {
        $this->idfa = $idfa;

        return $this;
    }

    /** @inheritDoc */
    public function getIdfa(): ?string
    {
        return $this->idfa;
    }

    /** @inheritDoc */
    public function setIosVendorId(string $iosVendorId): self
    {
        $this->iosVendorId = $iosVendorId;

        return $this;
    }

    /** @inheritDoc */
    public function getIosVendorId(): ?string
    {
        return $this->iosVendorId;
    }

    /** @inheritDoc */
    public function setGaid(string $gaid): self
    {
        $this->gaid = $gaid;

        return $this;
    }

    /** @inheritDoc */
    public function getGaid(): ?string
    {
        return $this->gaid;
    }

    /** @inheritDoc */
    public function setAndroidId(string $androidId): self
    {
        $this->androidId = $androidId;

        return $this;
    }

    /** @inheritDoc */
    public function getAndroidId(): ?string
    {
        return $this->androidId;
    }

    /** @inheritDoc */
    public function setAdTrackingEnabled(int $adTrackingStatus = AdTracking::DEFAULT): self
    {
        $this->adTrackingEnabled = $adTrackingStatus;

        return $this;
    }

    /** @inheritDoc */
    public function getAdTrackingEnabled(): ?int
    {
        return $this->adTrackingEnabled;
    }

    /** @inheritDoc */
    public function setLvid(string $lvid): self
    {
        $this->lvid = $lvid;

        return $this;
    }

    /** @inheritDoc */
    public function getLvid(): ?string
    {
        return $this->lvid;
    }

    /** @inheritDoc */
    public function setAdBlocker(int $adBlockerStatus = AdBlocker::DEFAULT): self
    {
        $this->adBlocker = $adBlockerStatus;

        return $this;
    }

    /** @inheritDoc */
    public function getAdBlocker(): ?int
    {
        return $this->adBlocker;
    }

    /** @inheritDoc */
    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /** @inheritDoc */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

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
