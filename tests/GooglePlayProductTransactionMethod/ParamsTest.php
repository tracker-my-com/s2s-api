<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\GooglePlayProductTransactionMethod;

use Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod\Params
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
     * @return void
     */
    public function testSetFloatParam(): void
    {
        $params = new Params();
        self::assertNull($params->revenue);

        $params->revenue = 10.0;
        self::assertEquals(10.0, $params->revenue);

        $params->revenue = 5;
        self::assertEquals(5, $params->revenue);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->revenue = '100500';
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
     * @covers::reset
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
            'productId' => ['productId'],
            'token' => ['token'],
            'currency' => ['currency'],
        ];
    }
}
