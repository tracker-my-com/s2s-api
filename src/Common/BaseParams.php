<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;


/**
 * Base implementation for BaseParamsInterface
 */
class BaseParams
{
    /**
     * If you don’t, time of the event handling is used by default.
     *
     * @var int|null Unix timestamp of moment when this event occurred.
     */
    public ?int $eventTimestamp = null;

    /**
     * We use this value to keep events separately for each user.
     *
     * @see https://tracker.my.com/docs/tracking/user_tracking
     *
     * @var string|null User ID in your project or application
     */
    public ?string $customUserId = null;

    /**
     * Set IPv4 actual when the event occurred, and we try to resolve it geo.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @var string|null IPv4 value as string, e.g. 8.8.8.8
     */
    public ?string $ipv4 = null;

    /**
     * Set IPv6 actual when the event occurred and we try to resolve it geo.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @var string|null IPv6 value
     */
    public ?string $ipv6 = null;

    /**
     * Set user's gender if you know it.
     * We use this value to split statistics by gender.
     *
     * @see Gender for gender ID values.
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @var int|null User gender ID
     */
    public ?int $idGender = null;

    /**
     * Set user's age in years if you know it.
     * We use this value to split statistics by user ages.
     *
     * @see https://tracker.my.com/docs/reports/selector-set/geo-n-demography
     *
     * @var int|null User age in years, e.g. "25"
     */
    public ?int $age = null;

    /**
     * Set connection type if you know what kind of internet connection was used when event occurred.
     * We use this value to split statistics by connection types.
     *
     * @see ConnectionType for connection type ID values.
     * @see https://tracker.my.com/docs/reports/selectors/device/connection-type
     *
     * @var int|null Connection type ID
     */
    public ?int $connectionType = null;

    /**
     * Set Bluetooth state if you know what it was when the event occurred.
     * We use this value to split statistics by Bluetooth state.
     *
     * @see Bluetooth for Bluetooth states.
     * @see https://tracker.my.com/docs/reports/selectors/device/bluetooth-enabled
     *
     * @var int|null Bluetooth state ID
     */
    public ?int $bluetoothEnabled = null;

    /**
     * Set instanceId if the event occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @see https://tracker.my.com/docs/sdk/ios/api/#get_instanceId How to get instanceId for iOS
     * @see https://tracker.my.com/docs/sdk/android/api/#get_instanceId How to get instanceId for Android
     *
     * @var string|null InstanceId value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     */
    public ?string $instanceId = null;

    /**
     * Set IDFA if event was occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @var string|null IDFA value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     */
    public ?string $idfa = null;

    /**
     * Set iOS vendor ID if the event occurred on iPhone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @var string|null iOS vendor ID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     */
    public ?string $iosVendorId = null;

    /**
     * Set GAID if the event occurred on cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @var string|null GAID value, 36 symbols in form "00000000-0000-0000-0000-000000000000"
     */
    public ?string $gaid = null;

    /**
     * Set android ID if the event occurred on Android cellphone.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @var string|null $androidId Android ID value, 16 symbols in form "000000000000000"
     */
    public ?string $androidId = null;

    /**
     * Set AD tracking status on user device if you know what it was when the event occurred.
     * We use this value to split statistics by AD tracking status.
     *
     * @see AdTracking for AD tracking statuses.
     * @see https://tracker.my.com/docs/reports/selectors/device/ad-tracking-enabled
     *
     * @var int|null AD tracking status ID
     */
    public ?int $adTrackingEnabled = null;

    /**
     * Set lvid if the event occurred on browser.
     * We use this value to keep device statistics separately and for advertising attribution.
     *
     * @var string|null Lvid value, 32 symbols in form "00000000000000000000000000000000"
     */
    public ?string $lvid = null;

    /**
     * Set ad blocker status in user's browser if you know what it was when the event occurred.
     * We use this value to split statistics by Ad blocker status.
     *
     * @see AdBlocker for Ad blocker statuses.
     *
     * @var int|null Ad blocker status ID
     */
    public ?int $adBlocker = null;

    /**
     * Set browser's User-Agent if you know what it was when the event occurred.
     * We use this value to split statistics by browser families.
     *
     * @see https://tracker.my.com/docs/reports/selectors/device/browser
     *
     * @var string|null User-Agent value
     */
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
