<?php declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mycom\Tracker\S2S\Api\Client;
use Mycom\Tracker\S2S\Api\Client\ConfigInterface;
use Mycom\Tracker\S2S\Api\Client\MethodInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers Client
 */
class ClientTest extends TestCase
{
    /** @var ConfigInterface|MockObject */
    protected $config;

    /** @var MethodInterface|MockObject */
    protected $method;

    /** @var Client */
    protected $client;

    /** @var MockHandler */
    protected $mockHandler;

    /** @var HttpClient */
    protected $httpClient;

    /** @inheritDoc */
    public function setUp()
    {
        $this->mockHandler = new MockHandler();
        $handler = HandlerStack::create($this->mockHandler);
        $this->httpClient = new HttpClient(['handler' => $handler]);

        $this->config = $this->createMock(ConfigInterface::class);
        $this->config->expects(self::once())
            ->method('getVersion')
            ->willReturn(1);
        $this->config->expects(self::once())
            ->method('getEndpointAddress')
            ->willReturn('test.local');

        $this->method = $this->createMock(MethodInterface::class);
        $this->method->expects(self::once())->method('validate');
        $this->method->expects(self::once())->method('getUri');
        $this->method->expects(self::once())->method('getRequestOptions');
    }

    /**
     * Test OK response
     */
    public function testOk()
    {
        $response = new Response(200, [], 'OK');
        $this->mockHandler->append($response);

        $this->client = new Client($this->httpClient, $this->config);
        $result = $this->client->request($this->method);

        self::assertEquals(200, $result->getStatusCode());
    }

    /**
     * Test 403 response
     */
    public function testNotFound()
    {
        self::expectException(ClientException::class);

        $response = new Response(403);
        $this->mockHandler->append($response);

        $this->client = new Client($this->httpClient, $this->config);
        $this->client->request($this->method);
    }
}
