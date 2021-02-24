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
    /** @var Params */
    protected Params $params;

    /** @inheritDoc */
    public function setUp(): void
    {
        $this->params = new Params();
    }

    /**
     * @covers ::setIdTransaction
     */
    public function testSetIdTransaction(): void
    {
        self::assertNull($this->params->getIdTransaction());

        $this->params->setIdTransaction('testTransaction');
        self::assertEquals('testTransaction', $this->params->getIdTransaction());

        $this->params->setIdTransaction('testTransactionNext');
        self::assertEquals('testTransactionNext', $this->params->getIdTransaction());
    }
    /**
     * @covers ::setTotal
     */
    public function testSetTotal(): void
    {
        self::assertNull($this->params->getTotal());

        $this->params->setTotal(10);
        self::assertSame(10.0, $this->params->getTotal());

        $this->params->setTotal(100.4);
        self::assertEquals(100.4, $this->params->getTotal());
    }

    /**
     * @covers ::toArray
     */
    public function testToArray(): void
    {
        self::assertEmpty($this->params->toArray());

        $this->params->setIdTransaction('testTransaction');
        self::assertArrayHasKey('idTransaction', $this->params->toArray());

        $this->params->reset();
        self::assertEmpty($this->params->toArray());
    }

    /**
     * @covers ::reset
     * @depends testSetIdTransaction
     */
    public function testReset(): void
    {
        $this->params->setIdTransaction('testTransaction');

        $this->params->reset();
        self::assertNull($this->params->getIdGender());
        self::assertEmpty($this->params->toArray());
    }
}
