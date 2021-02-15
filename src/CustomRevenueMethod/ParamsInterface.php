<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Common\{AdBlocker, AdTracking, Bluetooth, ConnectionType, Gender};

/**
 * Represents custom event params
 */
interface ParamsInterface
{
    /**
     * Set ID of the transaction in the client's system.
     *
     * @param string $idTransaction Transaction identifier, 1-255 characters, example: order1234
     *
     * @return ParamsInterface
     */
    public function setIdTransaction(string $idTransaction): ParamsInterface;

    /**
     * Set transaction currency code in ISO-4217
     *
     * @param string $currency Transaction currency, 3 characters, example: USD
     *
     * @return ParamsInterface
     */
    public function setCurrency(string $currency): ParamsInterface;

    /**
     * Set amount of transaction
     *
     * @param float $total Transaction total, 4-digit precision, example: 1.99
     *
     * @return ParamsInterface
     */
    public function setTotal(float $total): ParamsInterface;

    /**
     * Set event time.
     * If you don’t, time of the event handling is used by default.
     *
     * @param int $ts Unix timestamp of moment when this event occurred.
     *
     * @return ParamsInterface
     */
    public function setEventTimestamp(int $ts): ParamsInterface;

    /**
     * Set user ID to track users.
     * We use this value to keep events separately for each user.
     * @see https://tracker.my.com/docs/tracking/user_tracking User tracking
     *
     * @param string $userId User ID in your project or application
     *
     * @return ParamsInterface
     */
    public function setCustomUserId(string $userId): ParamsInterface;

    /**
     * Set ipv4 actual when the event occurred, and we try to resolve it geo.
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param string $ipv4 IPv4 value as string, e.g. 8.8.8.8
     *
     * @return ParamsInterface
     */
    public function setIpv4(string $ipv4): ParamsInterface;

    /**
     * Set ipv6 actual when the event occurred and we try to resolve it geo.
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param string $ipv6 IPv6 value
     *
     * @return ParamsInterface
     */
    public function setIpv6(string $ipv6): ParamsInterface;

    /**
     * Set user's gender if you know it.
     * We use this value to split statistics by gender.
     * @param int $idGender User gender ID
     *
     * @return ParamsInterface
     * @see Gender for gender ID values.
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     */
    public function setIdGender(int $idGender = Gender::UNKNOWN): ParamsInterface;

    /**
     * Set user's age in years if you know it.
     * We use this value to split statistics by user ages.
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @param int $age User age in years, e.g. "25"
     *
     * @return ParamsInterface
     */
    public function setAge(int $age): ParamsInterface;

    /**
     * Set connection type if you know what kind of internet connection was used when event occurred.
     * We use this value to split statistics by connection types.
     * @param int $connectionType Connection type ID
     *
     * @return ParamsInterface
     * @see ConnectionType for connection type ID values.
     * @see https://tracker.my.com/docs/reports/selectors/device/connection-type
     *
     */
    public function setConnectionType(int $connectionType = ConnectionType::DEFAULT): ParamsInterface;

    /**
     * Set Bluetooth state if you know what it was when the event occurred.
     * We use this value to split statistics by Bluetooth state.
     * @param int $bluetoothStatus Bluetooth state ID
     *
     * @return ParamsInterface
     * @see Bluetooth for Bluetooth states.
     * @see https://tracker.my.com/docs/reports/selectors/device/bluetooth-enabled
     *
     */
    public function setBluetoothEnabled(int $bluetoothStatus = Bluetooth::DEFAULT): ParamsInterface;

    /**
     * Set instanceId if the event occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $instanceId InstanceId value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     * @see https://tracker.my.com/docs/sdk/ios/api/#get_instanceId How to get instanceId for iOS
     * @see https://tracker.my.com/docs/sdk/android/api/#get_instanceId How to get instanceId for Android
     */
    public function setInstanceId(string $instanceId): ParamsInterface;

    /**
     * Set IDFA if event was occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $idfa IDFA value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setIdfa(string $idfa): ParamsInterface;

    /**
     * Set iOS vendor ID if the event occurred on iPhone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $iosVendorId iOS vendor ID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setIosVendorId(string $iosVendorId): ParamsInterface;

    /**
     * Set GAID if the event occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $gaid GAID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     *
     * @return ParamsInterface
     */
    public function setGaid(string $gaid): ParamsInterface;

    /**
     * Set android ID if the event occurred on Android cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $androidId Android ID value, 16 symbols in form "000000000000000"
     *
     * @return ParamsInterface
     */
    public function setAndroidId(string $androidId): ParamsInterface;

    /**
     * Set AD tracking status on user device if you know what it was when the event occurred.
     * We use this value to split statistics by AD tracking status.
     * @param int $adTrackingStatus AD tracking status ID
     *
     * @return ParamsInterface
     * @see AdTracking for AD tracking statuses.
     * @see https://tracker.my.com/docs/reports/selectors/device/ad-tracking-enabled
     *
     */
    public function setAdTrackingEnabled(int $adTrackingStatus = AdTracking::DEFAULT): ParamsInterface;

    /**
     * Set lvid if the event occurred on browser.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @param string $lvid Lvid value, 32 symbols in form "00000000000000000000000000000000"
     *
     * @return ParamsInterface
     */
    public function setLvid(string $lvid): ParamsInterface;

    /**
     * Set ad blocker status in user's browser if you know what it was when the event occurred.
     * We use this value to split statistics by Ad blocker status.
     * @param int $adBlockerStatus Ad blocker status ID
     *
     * @return ParamsInterface
     * @see AdBlocker for Ad blocker statuses.
     *
     */
    public function setAdBlocker(int $adBlockerStatus = AdBlocker::DEFAULT): ParamsInterface;

    /**
     * Set browser's User-Agent if you know what it was when the event occurred.
     * We use this value to split statistics by browser families.
     * @see https://tracker.my.com/docs/reports/selectors/device/browser
     *
     * @param string $userAgent User-Agent value
     *
     * @return ParamsInterface
     */
    public function setUserAgent(string $userAgent): ParamsInterface;


    /**
     * Get current revenue transaction identifier
     *
     * @return string|null
     */
    public function getIdTransaction();

    /**
     * Get current revenue currency code
     *
     * @return string|null
     */
    public function getCurrency();

    /**
     * Get current revenue total value
     *
     * @return float|null
     */
    public function getTotal();

    /**
     * Get current event timestamp value
     * @return int|null
     */
    public function getEventTimestamp();

    /**
     * Get current user ID value
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
    public function getIpv6();

    /**
     * Get current gender ID value
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
     * Get current Bluetooth state value
     * @return int|null
     */
    public function getBluetoothEnabled();

    /**
     * Get current instanceId value
     * @return string|null
     */
    public function getInstanceId();

    /**
     * Get current IDFA value
     * @return string|null
     */
    public function getIdfa();

    /**
     * Get current vendor ID value
     * @return string|null
     */
    public function getIosVendorId();

    /**
     * Get current GAID value
     * @return string|null
     */
    public function getGaid();

    /**
     * Get current Android ID value
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
     * Get current User Agent value
     * @return string|null
     */
    public function getUserAgent();

    /**
     * Reset all params
     * @return void
     */
    public function reset();
}
