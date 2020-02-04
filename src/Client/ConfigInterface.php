<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

/**
 * Represents an myTracker s2s client config
 */
interface ConfigInterface
{
    /**
     * Returns endpoint address.
     *
     * @return string
     */
    public function getEndpointAddress(): string;

    /**
     * Returns myTracker s2s api version.
     *
     * @return int
     */
    public function getVersion(): int;
}
