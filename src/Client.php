<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\{Client as HttpClient, ClientInterface as HttpClientInterface};
use Mycom\Tracker\S2S\Api\Client\{ClientInterface, Config, ConfigInterface, MethodInterface};
use Psr\Http\Message\ResponseInterface;

/**
 * Default myTracker s2s api client implementation
 */
final class Client implements ClientInterface
{
    /** @var HttpClientInterface */
    private $httpClient;

    /** @var string Endpoint address */
    private $endpoint;

    /** @var int Api version */
    private $version;

    /**
     * Return default tracker s2s api client
     *
     * @return ClientInterface
     */
    public static function getDefault(): ClientInterface
    {
        $httpClient = new HttpClient();
        $config = Config::getDefault();

        return new Client($httpClient, $config);
    }

    /**
     * Client constructor.
     *
     * @param HttpClientInterface $httpClient
     * @param ConfigInterface $config
     */
    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->endpoint = $config->getEndpointAddress();
        $this->version = $config->getVersion();
    }

    /** @inheritDoc */
    public function request(MethodInterface $method): ResponseInterface
    {
        $method->validate();

        $uri = implode(
            '/',
            [
                $this->endpoint,
                'v' . $this->version,
                $method->getUri(),
            ]
        );

        $options = $method->getRequestOptions();

        return $this->httpClient->request('POST', $uri, $options);
    }
}
