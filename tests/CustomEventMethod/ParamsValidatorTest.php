<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\CustomEventMethod\{ParamsInterface, ParamsValidator};
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\CustomEventMethod\ParamsValidator
 */
class ParamsValidatorTest extends TestCase
{
    /** @var ParamsValidator */
    protected ParamsValidator $validator;

    /** @var ParamsInterface|MockObject */
    protected ParamsInterface $params;

    /** @inheritDoc */
    public function setUp(): void
    {
        $this->params = $this->createMock(ParamsInterface::class);
        $this->validator = new ParamsValidator($this->params);
    }

    /**
     * @covers ::validate
     * @dataProvider validateCustomEventNameRequiredProvider
     *
     * @param bool $okExpected
     * @param string|null $customEventName
     */
    public function testValidateCustomEventNameRequired(bool $okExpected, ?string $customEventName): void
    {
        $this->params->expects(self::once())
            ->method('getCustomEventName')
            ->willReturn($customEventName);

        if (!$okExpected) {
            $this->expectException(InvalidArgumentException::class);
        }

        $this->validator->validate();

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
