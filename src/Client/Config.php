<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

/**
 * myTracker s2s client config
 */
final class Config implements ConfigInterface
{
    /** @var string Default myTracker s2s api endpoint */
    const DEFAULT_ENDPOINT = 'https://tracker-s2s.my.com';

    /** @var int myTracker s2s api version */
    const DEFAULT_VERSION = 1;

    /** @var string myTracker s2s api endpoint */
    private $endpoint;

    /** @var int myTracker s2s api version */
    private $version;

    /**
     * Return default config
     *
     * @return ConfigInterface
     */
    public static function getDefault(): ConfigInterface
    {
        return new Config(self::DEFAULT_ENDPOINT, self::DEFAULT_VERSION);
    }

    /**
     * Config constructor.
     *
     * @param string $endpoint myTracker s2s api endpoint
     * @param int    $version  myTracker s2s api version
     */
    public function __construct(string $endpoint, int $version)
    {
        $this->endpoint = $endpoint;
        $this->version = $version;
    }

    /** @inheritDoc */
    public function getEndpointAddress(): string
    {
        return $this->endpoint;
    }

    /** @inheritDoc */
    public function getVersion(): int
    {
        return $this->version;
    }
}
