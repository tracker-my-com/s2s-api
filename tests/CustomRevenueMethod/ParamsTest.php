<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\CustomRevenueMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\CustomRevenueMethod\Params
 */
class ParamsTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetIdTransaction(): void
    {
        $params = new Params();
        self::assertNull($params->idTransaction);

        $params->idTransaction = 'test';
        self::assertEquals('test', $params->idTransaction);

        $params->idTransaction = 'test_overwrite';
        self::assertEquals('test_overwrite', $params->idTransaction);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->idTransaction = 100500;
    }

    /**
     * @return void
     */
    public function testSetTotal(): void
    {
        $params = new Params();
        self::assertNull($params->total);

        $params->total = 0.23;
        self::assertEquals(0.23, $params->total);

        $params->total = 100;
        self::assertEquals(100, $params->total);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->total = '100500';
    }

    /**
     * @covers ::toArray
     * @depends testSetIdTransaction
     */
    public function testToArray(): void
    {
        $params = new Params();
        self::assertEmpty($params->toArray());

        $params->idTransaction = 'testTransaction';
        self::assertArrayHasKey('idTransaction', $params->toArray());
        self::assertEquals('testTransaction', $params->toArray()['idTransaction']);
    }

    /**
     * @covers ::reset
     * @depends testSetIdTransaction
     * @depends testToArray
     */
    public function testReset(): void
    {
        $params = new Params();
        $params->idTransaction = 'testTransaction';

        $params->reset();
        self::assertNull($params->idTransaction);
        self::assertEmpty($params->toArray());
    }
}
