<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\CustomEventMethod\{ParamsInterface, ParamsValidator};
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers ParamsValidator
 */
class ParamsValidatorTest extends TestCase
{
    /** @var ParamsValidator */
    protected $validator;

    /** @var ParamsInterface|MockObject */
    protected $params;

    /** @inheritDoc */
    public function setUp()
    {
        $this->params = $this->createMock(ParamsInterface::class);
        $this->validator = new ParamsValidator($this->params);
    }

    /**
     * @dataProvider validateCustomEventNameRequiredProvider
     *
     * @param bool $okExpected
     * @param string|null $customEventName
     */
    public function testValidateCustomEventNameRequired(bool $okExpected, $customEventName)
    {
        $this->params->expects(self::once())
            ->method('getCustomEventName')
            ->willReturn($customEventName);

        if (!$okExpected) {
            $this->expectException(InvalidArgumentException::class);
        }

        $this->validator->validateCustomEventNameRequired();

        if ($okExpected) {
            self::assertTrue(true);
        }
    }

    /**
     * @return array
     */
    public function validateCustomEventNameRequiredProvider(): array
    {
        return [
            'Empty string' => [false, ''],
            'Not set' => [false, null],

            'String zero' => [true, '0'],
            'Some non-empty' => [true, 'levelUp'],
            'Caret' => [true, "\n"],
            'Tab' => [true, "\t"],
            'Space' => [true, ' '],
        ];
    }
}
