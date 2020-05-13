<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\UserEventMethod;

use Mycom\Tracker\S2S\Api\Common\{AdBlocker, AdTracking, Bluetooth, ConnectionType, Gender};

/**
 * Represents common event params
 */
final class Params implements ParamsInterface
{
    /** @var int */
    private $eventTimestamp;

    /** @var string */
    protected $customUserId;

    /** @var string */
    private $ipv4;

    /** @var string */
    private $ipv6;

    /** @var int */
    private $idGender;

    /** @var int */
    private $age;

    /** @var int */
    private $connectionType;

    /** @var int */
    private $bluetoothEnabled;

    /** @var string */
    private $instanceId;

    /** @var string */
    private $idfa;

    /** @var string */
    private $iosVendorId;

    /** @var string */
    private $gaid;

    /** @var string */
    private $androidId;

    /** @var int */
    private $adTrackingEnabled;

    /** @var string */
    private $lvid;

    /** @var int */
    private $adBlocker;

    /** @var string */
    private $userAgent;

    /**  @inheritDoc */
    public function setEventTimestamp(int $ts): ParamsInterface
    {
        $this->eventTimestamp = $ts;

        return $this;
    }

    /**  @inheritDoc */
    public function setCustomUserId(string $userId): ParamsInterface
    {
        $this->customUserId = $userId;

        return $this;
    }

    /**  @inheritDoc */
    public function setIpv4(string $ipv4): ParamsInterface
    {
        $this->ipv4 = $ipv4;

        return $this;
    }

    /**  @inheritDoc */
    public function setIpv6(string $ipv6): ParamsInterface
    {
        $this->ipv6 = $ipv6;

        return $this;
    }

    /**  @inheritDoc */
    public function setIdGender(int $idGender = Gender::UNKNOWN): ParamsInterface
    {
        $this->idGender = $idGender;

        return $this;
    }

    /**  @inheritDoc */
    public function setAge(int $age): ParamsInterface
    {
        $this->age = $age;

        return $this;
    }

    /**  @inheritDoc */
    public function setConnectionType(int $connectionType = ConnectionType::DEFAULT): ParamsInterface
    {
        $this->connectionType = $connectionType;

        return $this;
    }

    /**  @inheritDoc */
    public function setBluetoothEnabled(int $bluetoothStatus = Bluetooth::DEFAULT): ParamsInterface
    {
        $this->bluetoothEnabled = $bluetoothStatus;

        return $this;
    }

    /** @inheritDoc */
    public function setInstanceId(string $instanceId): ParamsInterface
    {
        $this->instanceId = $instanceId;

        return $this;
    }

    /** @inheritDoc */
    public function setIdfa(string $idfa): ParamsInterface
    {
        $this->idfa = $idfa;

        return $this;
    }

    /** @inheritDoc */
    public function setIosVendorId(string $iosVendorId): ParamsInterface
    {
        $this->iosVendorId = $iosVendorId;

        return $this;
    }

    /** @inheritDoc */
    public function setGaid(string $gaid): ParamsInterface
    {
        $this->gaid = $gaid;

        return $this;
    }

    /** @inheritDoc */
    public function setAndroidId(string $androidId): ParamsInterface
    {
        $this->androidId = $androidId;

        return $this;
    }

    /** @inheritDoc */
    public function setAdTrackingEnabled(int $adTrackingStatus = AdTracking::DEFAULT): ParamsInterface
    {
        $this->adTrackingEnabled = $adTrackingStatus;

        return $this;
    }

    /** @inheritDoc */
    public function setLvid(string $lvid): ParamsInterface
    {
        $this->lvid = $lvid;

        return $this;
    }

    /** @inheritDoc */
    public function setAdBlocker(int $adBlockerStatus = AdBlocker::DEFAULT): ParamsInterface
    {
        $this->adBlocker = $adBlockerStatus;

        return $this;
    }

    /** @inheritDoc */
    public function setUserAgent(string $userAgent): ParamsInterface
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /** @inheritDoc */
    public function getEventTimestamp()
    {
        return $this->eventTimestamp;
    }

    /** @inheritDoc */
    public function getCustomUserId()
    {
        return $this->customUserId;
    }

    /** @inheritDoc */
    public function getIpv4()
    {
        return $this->ipv4;
    }

    /** @inheritDoc */
    public function getIpv6(): string
    {
        return $this->ipv6;
    }

    /** @inheritDoc */
    public function getIdGender()
    {
        return $this->idGender;
    }

    /** @inheritDoc */
    public function getAge()
    {
        return $this->age;
    }

    /** @inheritDoc */
    public function getConnectionType()
    {
        return $this->connectionType;
    }

    /** @inheritDoc */
    public function getBluetoothEnabled()
    {
        return $this->bluetoothEnabled;
    }

    /** @inheritDoc */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /** @inheritDoc */
    public function getIdfa()
    {
        return $this->idfa;
    }

    /** @inheritDoc */
    public function getIosVendorId()
    {
        return $this->iosVendorId;
    }

    /** @inheritDoc */
    public function getGaid()
    {
        return $this->gaid;
    }

    /** @inheritDoc */
    public function getAndroidId()
    {
        return $this->androidId;
    }

    /** @inheritDoc */
    public function getAdTrackingEnabled()
    {
        return $this->adTrackingEnabled;
    }

    /** @inheritDoc */
    public function getLvid()
    {
        return $this->lvid;
    }

    /** @inheritDoc */
    public function getAdBlocker()
    {
        return $this->adBlocker;
    }

    /** @inheritDoc */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /** @inheritDoc */
    public function reset()
    {
        foreach ($this as $k => $v) {
            $this->$k = null;
        }
    }

    /**
     * Get all params as assoc array
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter(
            get_object_vars($this),
            function ($v) {
                return isset($v);
            }
        );
    }
}
