<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;


/**
 * Represents custom event params
 */
interface BaseParamsInterface
{

    /**
     * Set event time.
     * If you don’t, time of the event handling is used by default.
     *
     * @param int $ts Unix timestamp of moment when this event occurred.
     *
     * @return $this
     */
    public function setEventTimestamp(int $ts): self;

    /**
     * Get current event timestamp value
     *
     * @return int|null
     */
    public function getEventTimestamp(): ?int;

    /**
     * Set user ID to track users.
     * We use this value to keep events separately for each user.
     *
     * @see https://tracker.my.com/docs/tracking/user_tracking User tracking
     *
     * @param string $userId User ID in your project or application
     *
     * @return $this
     */
    public function setCustomUserId(string $userId): self;

    /**
     * Get current user ID value
     *
     * @return string|null
     */
    public function getCustomUserId(): ?string;

    /**
     * Set ipv4 actual when the event occurred, and we try to resolve it geo.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param string $ipv4 IPv4 value as string, e.g. 8.8.8.8
     *
     * @return $this
     */
    public function setIpv4(string $ipv4): self;

    /**
     * Get current IPv4 value
     *
     * @return string|null
     */
    public function getIpv4(): ?string;


    /**
     * Set ipv6 actual when the event occurred and we try to resolve it geo.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param string $ipv6 IPv6 value
     *
     * @return $this
     */
    public function setIpv6(string $ipv6): self;

    /**
     * Get current IPv6 value
     *
     * @return string|null
     */
    public function getIpv6(): ?string;

    /**
     * Set user's gender if you know it.
     * We use this value to split statistics by gender.
     *
     * @see Gender for gender ID values.
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param int $idGender User gender ID
     *
     * @return $this
     */
    public function setIdGender(int $idGender = Gender::UNKNOWN): self;

    /**
     * Get current gender ID value
     *
     * @return int|null
     */
    public function getIdGender(): ?int;

    /**
     * Set user's age in years if you know it.
     * We use this value to split statistics by user ages.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param int $age User age in years, e.g. "25"
     *
     * @return $this
     */
    public function setAge(int $age): self;

    /**
     * Get current age value
     *
     * @return int|null
     */
    public function getAge(): ?int;

    /**
     * Set connection type if you know what kind of internet connection was used when event occurred.
     * We use this value to split statistics by connection types.
     *
     * @see ConnectionType for connection type ID values.
     * @see https://tracker.my.com/docs/reports/selectors/device/connection-type
     *
     * @param int $connectionType Connection type ID
     *
     * @return $this
     */
    public function setConnectionType(int $connectionType = ConnectionType::DEFAULT): self;

    /**
     * Get current connection type value
     *
     * @return int|null
     */
    public function getConnectionType(): ?int;

    /**
     * Set Bluetooth state if you know what it was when the event occurred.
     * We use this value to split statistics by Bluetooth state.
     *
     * @see Bluetooth for Bluetooth states.
     * @see https://tracker.my.com/docs/reports/selectors/device/bluetooth-enabled
     *
     * @param int $bluetoothStatus Bluetooth state ID
     *
     * @return $this
     */
    public function setBluetoothEnabled(int $bluetoothStatus = Bluetooth::DEFAULT): self;

    /**
     * Get current Bluetooth state value
     *
     * @return int|null
     */
    public function getBluetoothEnabled(): ?int;

    /**
     * Set instanceId if the event occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @see https://tracker.my.com/docs/sdk/ios/api/#get_instanceId How to get instanceId for iOS
     * @see https://tracker.my.com/docs/sdk/android/api/#get_instanceId How to get instanceId for Android
     *
     * @param string $instanceId InstanceId value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return $this
     */
    public function setInstanceId(string $instanceId): self;

    /**
     * Get current instanceId value
     *
     * @return string|null
     */
    public function getInstanceId(): ?string;

    /**
     * Set IDFA if event was occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $idfa IDFA value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return $this
     */
    public function setIdfa(string $idfa): self;

    /**
     * Get current IDFA value
     *
     * @return string|null
     */
    public function getIdfa(): ?string;

    /**
     * Set iOS vendor ID if the event occurred on iPhone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $iosVendorId iOS vendor ID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return $this
     */
    public function setIosVendorId(string $iosVendorId): self;

    /**
     * Get current vendor ID value
     *
     * @return string|null
     */
    public function getIosVendorId(): ?string;

    /**
     * Set GAID if the event occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $gaid GAID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return $this
     */
    public function setGaid(string $gaid): self;

    /**
     * Get current GAID value
     *
     * @return string|null
     */
    public function getGaid(): ?string;

    /**
     * Set android ID if the event occurred on Android cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $androidId Android ID value, 16 symbols in form "000000000000000"
     *
     * @return $this
     */
    public function setAndroidId(string $androidId): self;

    /**
     * Get current Android ID value
     *
     * @return string|null
     */
    public function getAndroidId(): ?string;

    /**
     * Set AD tracking status on user device if you know what it was when the event occurred.
     * We use this value to split statistics by AD tracking status.
     *
     * @see AdTracking for AD tracking statuses.
     * @see https://tracker.my.com/docs/reports/selectors/device/ad-tracking-enabled
     *
     * @param int $adTrackingStatus AD tracking status ID
     *
     * @return $this
     */
    public function setAdTrackingEnabled(int $adTrackingStatus = AdTracking::DEFAULT): self;

    /**
     * Get current ad tracking status value
     *
     * @return int|null
     */
    public function getAdTrackingEnabled(): ?int;

    /**
     * Set lvid if the event occurred on browser.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $lvid Lvid value, 32 symbols in form "00000000000000000000000000000000"
     *
     * @return $this
     */
    public function setLvid(string $lvid): self;

    /**
     * Get current lvid value
     *
     * @return string|null
     */
    public function getLvid(): ?string;

    /**
     * Set ad blocker status in user's browser if you know what it was when the event occurred.
     * We use this value to split statistics by Ad blocker status.
     *
     * @see AdBlocker for Ad blocker statuses.
     *
     * @param int $adBlockerStatus Ad blocker status ID
     *
     * @return $this
     *
     */
    public function setAdBlocker(int $adBlockerStatus = AdBlocker::DEFAULT): self;

    /**
     * Get current ad blocker status value
     *
     * @return int|null
     */
    public function getAdBlocker(): ?int;

    /**
     * Set browser's User-Agent if you know what it was when the event occurred.
     * We use this value to split statistics by browser families.
     *
     * @see https://tracker.my.com/docs/reports/selectors/device/browser
     *
     * @param string $userAgent User-Agent value
     *
     * @return $this
     */
    public function setUserAgent(string $userAgent): self;

    /**
     * Get current User Agent value
     *
     * @return string|null
     */
    public function getUserAgent(): ?string;

    /**
     * Reset all params
     *
     * @return void
     */
    public function reset(): void;
}
