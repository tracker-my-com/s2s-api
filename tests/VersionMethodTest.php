<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client;
use Mycom\Tracker\S2S\Api\Client\ClientInterface;
use Mycom\Tracker\S2S\Api\VersionMethod;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\VersionMethod
 */
class VersionMethodTest extends TestCase
{
    /** @var ClientInterface */
    protected ClientInterface $client;

    /** @var VersionMethod */
    protected VersionMethod $method;

    /** @inheritDoc */
    public function setUp(): void
    {
        $this->client = Client::getDefault();
        $this->method = new VersionMethod();
    }

    /**
     * Test method response
     * @group Integration
     */
    public function testRequest(): void
    {
        $response = $this->client->request($this->method);
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(JSON_ERROR_NONE, json_last_error());
        self::assertArrayHasKey(VersionMethod::VERSION_FIELD, $data);

        $majorVersion = explode('.', $data[VersionMethod::VERSION_FIELD])[0];

        self::assertEquals(Client\Config::DEFAULT_VERSION, $majorVersion);
    }
}
