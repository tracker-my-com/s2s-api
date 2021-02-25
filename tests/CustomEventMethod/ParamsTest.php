<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\CustomEventMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\CustomEventMethod\Params
 */
class ParamsTest extends TestCase
{
    /** @var Params */
    protected Params $params;

    /** @inheritDoc */
    public function setUp(): void
    {
        $this->params = new Params();
    }

    /**
     * @return void
     */
    public function testSetCustomEventName(): void
    {
        $params = new Params();
        self::assertNull($params->customEventName);

        $params->customEventName = 'test';
        self::assertEquals('test', $params->customEventName);

        $params->customEventName = 'test_overwrite';
        self::assertEquals('test_overwrite', $params->customEventName);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->customEventName = 100500;
    }

    /**
     * @covers ::toArray
     * @return void
     */
    public function testToArray(): void
    {
        $params = new Params();
        self::assertEmpty($params->toArray());

        $params->customEventName = 'test';
        self::assertArrayHasKey('customEventName', $params->toArray());
        self::assertEquals('test', $params->toArray()['customEventName']);
    }

    /**
     * @covers ::reset
     * @depends testToArray
     * @return void
     */
    public function testReset(): void
    {
        $params = new Params();
        $params->customEventName = 'test';

        $params->reset();
        self::assertNull($params->customEventName);
        self::assertEmpty($params->toArray());
    }
}
