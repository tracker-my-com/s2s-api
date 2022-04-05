<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\ClientInterface;
use Mycom\Tracker\S2S\Api\Client\MethodInterface;
use Mycom\Tracker\S2S\Api\CustomEventBatchMethod;
use Mycom\Tracker\S2S\Api\CustomEventMethod;
use Mycom\Tracker\S2S\Api\CustomRevenueBatchMethod;
use Mycom\Tracker\S2S\Api\CustomRevenueMethod;
use Mycom\Tracker\S2S\Api\Example;
use Mycom\Tracker\S2S\Api\GooglePlayProductTransactionBatchMethod;
use Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenBatchMethod;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionBatchMethod;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod;
use Mycom\Tracker\S2S\Api\LoginBatchMethod;
use Mycom\Tracker\S2S\Api\LoginMethod;
use Mycom\Tracker\S2S\Api\RegistrationBatchMethod;
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
     * @covers ::sendRegistrationEventBatch
     * @return void
     */
    public function testSendRegistrationEventBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(RegistrationBatchMethod::class, $method);
                self::assertEquals('registrationBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'idGender' => 2,
                            'age' => 25,
                            'lvid' => '00000000000000000000000000000001',
                        ],
                        [
                            'customUserId' => '42',
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendRegistrationEventBatch(1, 'secret', $client);
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
     * @covers ::sendLoginEventBatch
     * @return void
     */
    public function testSendLoginEventBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(LoginBatchMethod::class, $method);
                self::assertEquals('loginBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'eventTimestamp' => 1587564000,
                        ],
                        [
                            'customUserId' => '42',
                            'eventTimestamp' => 1587564120,
                            'ipv4' => '8.8.8.8',
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendLoginEventBatch(1, 'secret', $client);
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
     * @covers ::sendCustomEventBatch
     * @return void
     */
    public function testSendCustomEventBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(CustomEventBatchMethod::class, $method);
                self::assertEquals('customEventBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'customEventName' => 'levelUp',
                            'customEventParams' => ['level' => '2'],
                            'lvid' => '00000000000000000000000000000001',
                        ],
                        [
                            'customUserId' => '42',
                            'customEventName' => 'levelUp',
                            'customEventParams' => [
                                'level' => '5',
                                'coins' => '10',
                            ],
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendCustomEventBatch(1, 'secret', $client);
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

    /**
     * @covers ::sendCustomRevenueBatch
     * @return void
     */
    public function testSendCustomRevenueBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(CustomRevenueBatchMethod::class, $method);
                self::assertEquals('customRevenueBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'lvid' => '00000000000000000000000000000001',
                            'idTransaction' => 'order1',
                            'currency' => 'USD',
                            'total' => 4.5,
                        ],
                        [
                            'customUserId' => '42',
                            'idTransaction' => 'order2',
                            'currency' => 'RUB',
                            'total' => 3000.0,
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendCustomRevenueBatch(1, 'secret', $client);
    }

    /**
     * @covers ::sendGooglePlayProductTransaction
     * @return void
     */
    public function testSendGooglePlayProductTransaction(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlayProductTransactionMethod::class, $method);
                self::assertEquals('googlePlayProductTransaction', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'orderId' => '234-1234-1234-12345',
                        'productId' => '001',
                        'token' => 'ofjkingojelmkmedpgfkfelj',
                        'currency' => 'USD',
                        'revenue' => 10.0,
                        'eventTimestamp' => time()
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlayProductTransactionMethod::class, $method);
                self::assertEquals('googlePlayProductTransaction', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '500100',
                        'orderId' => '321-4321-4321-54321',
                        'productId' => '002',
                        'token' => 'jlefkfgpdemkmlejognikjfo',
                        'currency' => 'USD',
                        'revenue' => 20.0,
                        'eventTimestamp' => time()
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendGooglePlayProductTransaction(1, 'secret', $client);
    }

    /**
     * @covers ::sendGooglePlayProductTransactionBatch
     * @return void
     */
    public function testSendGooglePlayProductTransactionBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlayProductTransactionBatchMethod::class, $method);
                self::assertEquals('googlePlayProductTransactionBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'orderId' => '234-1234-1234-12345',
                            'productId' => '001',
                            'token' => 'ofjkingojelmkmedpgfkfelj',
                            'currency' => 'USD',
                            'revenue' => 10.0,
                            'eventTimestamp' => time()
                        ],
                        [
                            'customUserId' => '500100',
                            'orderId' => '321-4321-4321-54321',
                            'productId' => '002',
                            'token' => 'jlefkfgpdemkmlejognikjfo',
                            'currency' => 'USD',
                            'revenue' => 20.0,
                            'eventTimestamp' => time()
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendGooglePlayProductTransactionBatch(1, 'secret', $client);
    }

    /**
     * @covers ::sendGooglePlaySubscriptionTransaction
     * @return void
     */
    public function testSendGooglePlaySubscriptionTransaction(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlaySubscriptionTransactionMethod::class, $method);
                self::assertEquals('googlePlaySubscriptionTransaction', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'orderId' => '234-1234-1234-12345',
                        'eventTimestamp' => time(),
                        'priceCurrencyCode' => 'USD',
                        'priceAmountMicros' => 1990000,
                        'subscriptionId' => 'monthly001'
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlaySubscriptionTransactionMethod::class, $method);
                self::assertEquals('googlePlaySubscriptionTransaction', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '500100',
                        'orderId' => '234-1234-1234-54321',
                        'eventTimestamp' => time(),
                        'priceCurrencyCode' => 'USD',
                        'priceAmountMicros' => 5990000,
                        'subscriptionId' => 'monthly002',
                        'paymentState' => '1',
                        'isIntroductory' => 0,
                        'startTimeMillis' => 1693242344000,
                        'expiryTimeMillis' => 1693242344000,
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendGooglePlaySubscriptionTransaction(1, 'secret', $client);
    }

    /**
     * @covers ::sendGooglePlaySubscriptionTransactionBatch
     * @return void
     */
    public function testSendGooglePlaySubscriptionTransactionBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlaySubscriptionTransactionBatchMethod::class, $method);
                self::assertEquals('googlePlaySubscriptionTransactionBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'orderId' => '234-1234-4321-12345',
                            'priceCurrencyCode' => 'USD',
                            'eventTimestamp' => time(),
                            'priceAmountMicros' => 1990000,
                            'subscriptionId' => 'monthly001'
                        ],
                        [
                            'customUserId' => '500100',
                            'orderId' => '2345-1234-1234-12345',
                            'eventTimestamp' => time(),
                            'priceCurrencyCode' => 'USD',
                            'priceAmountMicros' => 5990000,
                            'subscriptionId' => 'monthly002',
                            'paymentState' => '1',
                            'isIntroductory' => 0,
                            'startTimeMillis' => 1693242344000,
                            'expiryTimeMillis' => 1693242344000,
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendGooglePlaySubscriptionTransactionBatch(1, 'secret', $client);
    }

    /**
     * @covers ::sendGooglePlaySubscriptionToken
     * @return void
     */
    public function testSendGooglePlaySubscriptionToken(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::at(0))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlaySubscriptionTokenMethod::class, $method);
                self::assertEquals('googlePlaySubscriptionToken', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'orderId' => '234-1234-1234-12345',
                        'eventTimestamp' => time(),
                        'token' => 'ofjkingojelmkmedpgfkfelj',
                        'subscriptionId' => 'monthly001'
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });
        $client
            ->expects(self::at(1))
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlaySubscriptionTokenMethod::class, $method);
                self::assertEquals('googlePlaySubscriptionToken', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        'customUserId' => '100500',
                        'orderId' => '234-1234-1234-12345',
                        'eventTimestamp' => time(),
                        'token' => 'jlefkfgpdemkmlejognikjfo',
                        'subscriptionId' => 'monthly001',
                        'subscriptionPeriod' => 'P1M'
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendGooglePlaySubscriptionToken(1, 'secret', $client);
    }

    /**
     * @covers ::sendGooglePlaySubscriptionTokenBatch
     * @return void
     */
    public function testSendGooglePlaySubscriptionTokenBatch(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects(self::once())
            ->method('request')
            ->willReturnCallback(static function (MethodInterface $method): ResponseInterface {
                self::assertInstanceOf(GooglePlaySubscriptionTokenBatchMethod::class, $method);
                self::assertEquals('googlePlaySubscriptionTokenBatch', $method->getUri());
                self::assertEquals([
                    RequestOptions::HEADERS => [ClientInterface::AUTH_HEADER_NAME => 'secret'],
                    RequestOptions::QUERY => ['idApp' => 1],
                    RequestOptions::JSON => [
                        [
                            'customUserId' => '100500',
                            'orderId' => '234-1234-1234-12345',
                            'eventTimestamp' => time(),
                            'subscriptionId' => 'monthly001',
                            'token' => 'ofjkingojelmkmedpgfkfelj'
                        ],
                        [
                            'customUserId' => '100500',
                            'orderId' => '234-1234-1234-12345',
                            'eventTimestamp' => time(),
                            'subscriptionId' => 'monthly001',
                            'token' => 'jlefkfgpdemkmlejognikjfo',
                            'subscriptionPeriod' => 'P1M',
                        ],
                    ],
                ], $method->getRequestOptions());
                return new Response(200, [], 'OK');
            });

        Example::sendGooglePlaySubscriptionTokenBatch(1, 'secret', $client);
    }
}
