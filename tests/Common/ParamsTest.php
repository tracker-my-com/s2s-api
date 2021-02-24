<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\Common;

use Mycom\Tracker\S2S\Api\Common\Gender;
use Mycom\Tracker\S2S\Api\UserEventMethod\Params;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\UserEventMethod\Params
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
     * @covers ::setIdGender
     */
    public function testSetIdGender(): void
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
     * @covers ::toArray
     */
    public function testToArray(): void
    {
        self::assertEmpty($this->params->toArray());

        $this->params->setIdGender(Gender::FEMALE);
        self::assertArrayHasKey('idGender', $this->params->toArray());

        $this->params->reset();
        self::assertEmpty($this->params->toArray());
    }

    /**
     * @covers ::reset
     * @depends testSetIdGender
     */
    public function testReset(): void
    {
        $this->params->setIdGender(Gender::FEMALE);

        $this->params->reset();
        self::assertNull($this->params->getIdGender());
        self::assertEmpty($this->params->toArray());
    }
}
