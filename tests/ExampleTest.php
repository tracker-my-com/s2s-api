<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\ClientInterface;
use Mycom\Tracker\S2S\Api\Client\MethodInterface;
use Mycom\Tracker\S2S\Api\CustomEventMethod;
use Mycom\Tracker\S2S\Api\CustomRevenueMethod;
use Mycom\Tracker\S2S\Api\Example;
use Mycom\Tracker\S2S\Api\LoginMethod;
use Mycom\Tracker\S2S\Api\RegistrationMethod;
use Mycom\Tracker\S2S\Api\TestAppAccessMethod;
use Mycom\Tracker\S2S\Api\VersionMethod;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\Example
 */
class ExampleTest extends TestCase
{

    /**
     * @covers ::getActualVersion
     * @return void
     */
    public function testGetActualVersion(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(VersionMethod::class, $method);
                self::assertEquals('version', $method->getUri());
                self::assertEquals([], $method->getRequestOptions());
                return new Response(200, [], '{"version":"1.0.0"}');
            });

        Example::getActualVersion($client);
    }

    /**
     * @covers ::testAppAccess
     * @return void
     */
    public function testTestAppAccess(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(TestAppAccessMethod::class, $method);
                self::assertEquals('test-app-access', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => true,
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::testAppAccess(1, 'secret', $client);
    }

    /**
     * @covers ::sendRegistrationEvent
     * @return void
     */
    public function testSendRegistrationEvent(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(RegistrationMethod::class, $method);
                self::assertEquals('registration', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'idGender' => 2,
                        'age' => 25,
                        'lvid' => '00000000000000000000000000000001',
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(RegistrationMethod::class, $method);
                self::assertEquals('registration', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '42',
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendRegistrationEvent(1, 'secret', $client);
    }

    /**
     * @covers ::sendLoginEvent
     * @return void
     */
    public function testSendLoginEvent(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(LoginMethod::class, $method);
                self::assertEquals('login', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'eventTimestamp' => 1587564000,
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(LoginMethod::class, $method);
                self::assertEquals('login', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '42',
                        'eventTimestamp' => 1587564120,
                        'ipv4' => '8.8.8.8',
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendLoginEvent(1, 'secret', $client);
    }

    /**
     * @covers ::sendCustomEvent
     * @return void
     */
    public function testSendCustomEvent(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(CustomEventMethod::class, $method);
                self::assertEquals('customEvent', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'customEventName' => 'levelUp',
                        'customEventParams' => ['level' => '2'],
                        'lvid' => '00000000000000000000000000000001',
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(CustomEventMethod::class, $method);
                self::assertEquals('customEvent', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '42',
                        'customEventName' => 'levelUp',
                        'customEventParams' => [
                            'level' => '5',
                            'coins' => '10',
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendCustomEvent(1, 'secret', $client);
    }

    /**
     * @covers ::sendCustomRevenue
     * @return void
     */
    public function testSendCustomRevenue(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(CustomRevenueMethod::class, $method);
                self::assertEquals('customRevenue', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'lvid' => '00000000000000000000000000000001',
                        'idTransaction' => 'order1',
                        'currency' => 'USD',
                        'total' => 4.5,
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(CustomRevenueMethod::class, $method);
                self::assertEquals('customRevenue', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '42',
                        'idTransaction' => 'order2',
                        'currency' => 'RUB',
                        'total' => 3000.0,
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendCustomRevenue(1, 'secret', $client);
    }
}
