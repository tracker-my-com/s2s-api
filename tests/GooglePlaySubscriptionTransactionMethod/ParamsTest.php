<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod
 */
class ParamsTest extends TestCase
{
    /**
     * @param string $paramName
     *
     * @return void
     * @dataProvider providerStringParams
     */
    public function testSetStringParams(string $paramName): void
    {
        $params = new Params();
        self::assertNull($params->$paramName);

        $params->$paramName = 'test';
        self::assertEquals('test', $params->$paramName);

        $params->$paramName = 'test_overwrite';
        self::assertEquals('test_overwrite', $params->$paramName);

        $this->expectException(\TypeError::class);
        $params->$paramName = 100500;
    }

    /**
     * @param string $paramName
     * @covers ::toArray
     * @return void
     * @dataProvider providerStringParams
     */
    public function testToArray(string $paramName): void
    {
        $params = new Params();
        self::assertEmpty($params->toArray());

        $params->$paramName = 'testString';
        self::assertArrayHasKey($paramName, $params->toArray());
        self::assertEquals('testString', $params->toArray()[$paramName]);
    }

    /**
     * @param string $paramName
     * @covers ::reset
     * @return void
     * @dataProvider providerStringParams
     */
    public function testReset(string $paramName): void
    {
        $params = new Params();
        $params->$paramName = 'testString';

        $params->reset();
        self::assertNull($params->$paramName);
        self::assertEmpty($params->toArray());
    }

    /**
     * @return array
     */
    public function providerStringParams(): array
    {
        return [
            'orderId' => ['orderId'],
            'priceCurrencyCode' => ['priceCurrencyCode'],
            'subscriptionId' => ['subscriptionId']
        ];
    }

    /**
     * @param string $paramName
     *
     * @return void
     * @dataProvider providerIntParams
     */
    public function testSetIntParams(string $paramName): void
    {
        $params = new Params();
        self::assertNull($params->$paramName);

        $params->$paramName = 1;
        self::assertEquals(1, $params->$paramName);

        $params->$paramName = 12;
        self::assertEquals(12, $params->$paramName);

        $this->expectException(\TypeError::class);
        $params->$paramName = "100500";
    }

    /**
     * @return array
     */
    public function providerIntParams(): array
    {
        return [
            'priceAmountMicros' => ['priceAmountMicros'],
            'isIntroductory' => ['isIntroductory'],
            'startTimeMillis' => ['startTimeMillis'],
            'expiryTimeMillis' => ['expiryTimeMillis'],
            'paymentState' => ['paymentState']
        ];
    }
}
