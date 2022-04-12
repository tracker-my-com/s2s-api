<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\AppStoreProductTransactionMethod;

use Mycom\Tracker\S2S\Api\AppStoreProductTransactionMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\AppStoreProductTransactionMethod\Params
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
            'transactionId' => ['transactionId'],
            'productId' => ['productId'],
            'currency' => ['currency']
        ];
    }

    /**
     * @return void
     */
    public function testIntParam(): void
    {
        $params = new Params();
        self::assertNull($params->quantity);

        $params->quantity = 1;
        self::assertEquals(1, $params->quantity);

        $params->quantity = 2;
        self::assertEquals(2, $params->quantity);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->quantity = "100500";
    }

    /**
     * @return void
     */
    public function testfloatParam(): void
    {
        $params = new Params();
        self::assertNull($params->price);

        $params->price = 1;
        self::assertEquals(1, $params->price);

        $params->price = 2.0;
        self::assertEquals(2.0, $params->price);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->price = "100500";
    }
}
