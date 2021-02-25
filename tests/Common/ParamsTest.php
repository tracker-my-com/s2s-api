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
    /**
     * @return void
     */
    public function testSetIdGender(): void
    {
        $params = new Params();
        self::assertNull($params->idGender);

        $params->idGender = Gender::MALE;
        self::assertEquals(Gender::MALE, $params->idGender);

        $params->idGender = Gender::FEMALE;
        self::assertEquals(Gender::FEMALE, $params->idGender);

        $this->expectException(\TypeError::class);
        /** @noinspection PhpStrictTypeCheckingInspection */
        $params->idGender = '100500';
    }

    /**
     * @covers ::toArray
     * @return void
     */
    public function testToArray(): void
    {
        $params = new Params();
        self::assertEmpty($params->toArray());

        $params->idGender = Gender::FEMALE;
        self::assertArrayHasKey('idGender', $params->toArray());
        self::assertEquals(Gender::FEMALE, $params->toArray()['idGender']);
    }

    /**
     * @covers ::reset
     * @depends testSetIdGender
     * @depends testToArray
     * @return void
     */
    public function testReset(): void
    {
        $params = new Params();
        $params->idGender = Gender::FEMALE;

        $params->reset();
        self::assertNull($params->idGender);
        self::assertEmpty($params->toArray());
    }
}
