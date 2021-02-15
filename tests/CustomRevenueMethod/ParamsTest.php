<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\CustomRevenueMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @covers Params
 */
class ParamsTest extends TestCase
{
    /** @var Params */
    protected $params;

    /** @inheritDoc */
    public function setUp()
    {
        $this->params = new Params();
    }

    /**
     * @covers Params::setIdTransaction
     */
    public function testSetIdTransaction()
    {
        self::assertNull($this->params->getIdTransaction());

        $this->params->setIdTransaction('testTransaction');
        self::assertEquals('testTransaction', $this->params->getIdTransaction());

        $this->params->setIdTransaction('testTransactionNext');
        self::assertEquals('testTransactionNext', $this->params->getIdTransaction());
    }
    /**
     * @covers Params::setTotal
     */
    public function testSetTotal()
    {
        self::assertNull($this->params->getTotal());

        $this->params->setTotal(10);
        self::assertSame(10.0, $this->params->getTotal());

        $this->params->setTotal(100.4);
        self::assertEquals(100.4, $this->params->getTotal());
    }

    /**
     * @covers Params::toArray
     */
    public function testToArray()
    {
        self::assertEmpty($this->params->toArray());

        $this->params->setIdTransaction('testTransaction');
        self::assertArrayHasKey('idTransaction', $this->params->toArray());

        $this->params->reset();
        self::assertEmpty($this->params->toArray());
    }

    /**
     * @covers Params::reset
     */
    public function testReset()
    {
        $this->params->setIdTransaction('testTransaction');

        $this->params->reset();
        self::assertNull($this->params->getIdGender());
        self::assertEmpty($this->params->toArray());
    }
}
