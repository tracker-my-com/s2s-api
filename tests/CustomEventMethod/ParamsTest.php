<?php

namespace MycomTest\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\Common\Gender;
use Mycom\Tracker\S2S\Api\CustomEventMethod\Params;
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
     * @covers Params::setIdGender
     */
    public function testSetIdGender()
    {
        self::assertNull($this->params->getIdGender());

        $this->params->setIdGender(Gender::MALE);
        self::assertEquals(Gender::MALE, $this->params->getIdGender());

        $this->params->setIdGender(Gender::FEMALE);
        self::assertEquals(Gender::FEMALE, $this->params->getIdGender());

        $this->params->setIdGender(100500);
        self::assertEquals(100500, $this->params->getIdGender());
    }

    /**
     * @covers Params::toArray
     */
    public function testToArray()
    {
        self::assertEmpty($this->params->toArray());

        $this->params->setIdGender(Gender::FEMALE);
        self::assertArrayHasKey('idGender', $this->params->toArray());

        $this->params->reset();
        self::assertEmpty($this->params->toArray());
    }

    /**
     * @covers Params::reset
     */
    public function testReset()
    {
        $this->params->setIdGender(Gender::FEMALE);

        $this->params->reset();
        self::assertNull($this->params->getIdGender());
        self::assertEmpty($this->params->toArray());
    }
}
