<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\UserEventMethod;

use Mycom\Tracker\S2S\Api\Common\{AdBlocker, AdTracking, Bluetooth, ConnectionType, Gender};

/**
 * Represents common event params
 */
interface ParamsInterface
{
    /**
     * Set event time.
     * Event handling time used by default if you not set the value.
     *
     * @param int $ts Unix timestamp of moment when this event was occurred.
     *
     * @return ParamsInterface
     */
    public function setEventTimestamp(int $ts): ParamsInterface;

    /**
     * Set user id value for user tracking ability.
     * We use that value to keep events separately for each user.
     * @see https://tracker.my.com/docs/tracking/user_tracking User tracking
     *
     * @param string $userId User id in your project or application
     *
     * @return ParamsInterface
     */
    public function setCustomUserId(string $userId): ParamsInterface;

    /**
     * Set ipv4 value actual when event was occurred and we try to resolve it geo.
     *
     * @param string $ipv4 IPv4 value as sting, e.g. 8.8.8.8
     *
     * @return ParamsInterface
     */
    public function setIpv4(string $ipv4): ParamsInterface;

    /**
     * Set ipv6 value actual when event was occurred and we try to resolve it geo.
     *
     * @param string $ipv6 IPv6 value
     *
     * @return ParamsInterface
     */
    public function setIpv6(string $ipv6): ParamsInterface;

    /**
     * Set users gender if you know it.
     * We use that value to split statistics by gender.
     * @param int $idGender User gender id
     *
     * @return ParamsInterface
     * @see Gender for gender id values.
     *
     */
    public function setIdGender(int $idGender = Gender::UNKNOWN): ParamsInterface;

    /**
     * Set users age in years if you know it.
     * We use that value to split statistics by user ages.
     *
     * @param int $age User age in years, e.g. "25"
     *
     * @return ParamsInterface
     */
    public function setAge(int $age): ParamsInterface;

    /**
     * Set connection type value if you know what kind of internet connection was used when event was occurred.
     * We use that value to split statistics by connection types.
     * @param int $connectionType Connection type id
     *
     * @return ParamsInterface
     * @see ConnectionType for connection type id values.
     *
     */
    public function setConnectionType(int $connectionType = ConnectionType::DEFAULT): ParamsInterface;

    /**
     * Set bluetooth status if you know what it was when event was occurred.
     * We use that value to split statistics by bluetooth status.
     * @param int $bluetoothStatus Bluetooth status id
     *
     * @return ParamsInterface
     * @see Bluetooth for bluetooth statuses.
     *
     */
    public function setBluetoothEnabled(int $bluetoothStatus = Bluetooth::DEFAULT): ParamsInterface;

    /**
     * Set instance id value if event was occurred on cellphone.
     * We use this value for keep device statistics separately and for advertising attribution.
     *
     * @param string $instanceId Instance id value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setInstanceId(string $instanceId): ParamsInterface;

    /**
     * Set IDFA value if event was occurred on cellphone.
     * We use this value for keep device statistics separately and for advertising attribution.
     *
     * @param string $idfa IDFA value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setIdfa(string $idfa): ParamsInterface;

    /**
     * Set iOS vendor id value if event was occurred on iPhone.
     * We use this value for keep device statistics separately and for advertising attribution.
     *
     * @param string $iosVendorId iOS vendor id value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setIosVendorId(string $iosVendorId): ParamsInterface;

    /**
     * Set GAID value if event was occurred on cellphone.
     * We use this value for keep device statistics separately and for advertising attribution.
     *
     * @param string $gaid GAID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setGaid(string $gaid): ParamsInterface;

    /**
     * Set android id value if event was occurred on android cellphone.
     * We use this value for keep device statistics separately and for advertising attribution.
     *
     * @param string $androidId Android id value, 16 symbols in form "000000000000000"
     *
     * @return ParamsInterface
     */
    public function setAndroidId(string $androidId): ParamsInterface;

    /**
     * Set AD tracking status on user device if you know what it was when event was occurred.
     * We use that value to split statistics by AD tracking status.
     * @param int $adTrackingStatus AD tracking status id
     *
     * @return ParamsInterface
     * @see AdTracking for AD trcking statuses.
     *
     */
    public function setAdTrackingEnabled(int $adTrackingStatus = AdTracking::DEFAULT): ParamsInterface;

    /**
     * Set Lvid value if event was occurred on browser.
     * We use this value for keep device statistics separately and for advertising attribution.
     *
     * @param string $lvid Lvid value, 32 symbols in form "00000000000000000000000000000000"
     *
     * @return ParamsInterface
     */
    public function setLvid(string $lvid): ParamsInterface;

    /**
     * Set Ad blocker status in users browser if you know what it was when event was occurred.
     * We use that value to split statistics by Ad blocker status.
     * @param int $adBlockerStatus Ad blocker status id
     *
     * @return ParamsInterface
     * @see AdBlocker for Ad blocker statuses.
     *
     */
    public function setAdBlocker(int $adBlockerStatus = AdBlocker::DEFAULT): ParamsInterface;

    /**
     * Set browser user-agent value if you know what it was when event was occurred.
     * We use that value to split statistics by browser families.
     *
     * @param string $userAgent User-agent value
     *
     * @return ParamsInterface
     */
    public function setUserAgent(string $userAgent): ParamsInterface;

    /**
     * Get current event timestamp value
     * @return int|null
     */
    public function getEventTimestamp();

    /**
     * Get current user id value
     * @return string|null
     */
    public function getCustomUserId();

    /**
     * Get current IPv4 value
     * @return string|null
     */
    public function getIpv4();

    /**
     * Get current IPv6 value
     * @return string|null
     */
    public function getIpv6(): string;

    /**
     * Get current gender id value
     * @return int|null
     */
    public function getIdGender();

    /**
     * Get current age value
     * @return int|null
     */
    public function getAge();

    /**
     * Get current connection type value
     * @return int|null
     */
    public function getConnectionType();

    /**
     * Get current bluetooth status value
     * @return int|null
     */
    public function getBluetoothEnabled();

    /**
     * Get current instance id value
     * @return string|null
     */
    public function getInstanceId();

    /**
     * Get current idfa value
     * @return string|null
     */
    public function getIdfa();

    /**
     * Get current vendor id value
     * @return string|null
     */
    public function getIosVendorId();

    /**
     * Get current gaid value
     * @return string|null
     */
    public function getGaid();

    /**
     * Get current android id value
     * @return string|null
     */
    public function getAndroidId();

    /**
     * Get current ad tracking status value
     * @return int|null
     */
    public function getAdTrackingEnabled();

    /**
     * Get current lvid value
     * @return string|null
     */
    public function getLvid();

    /**
     * Get current ad blocker status value
     * @return int|null
     */
    public function getAdBlocker();

    /**
     * Get current user agent value
     * @return string|null
     */
    public function getUserAgent();

    /**
     * Reset all params
     * @return void
     */
    public function reset();
}
