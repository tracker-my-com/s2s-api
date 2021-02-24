<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\Common;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\UserEventMethod\{ParamsInterface, ParamsValidator};
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\UserEventMethod\ParamsValidator
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
     * @covers ::validateCustomUserIdRequired
     * @dataProvider validateCustomUserIdRequiredProvider
     *
     * @param bool        $okExpected
     * @param string|null $customUserId
     */
    public function testValidateCustomUserIdRequired(bool $okExpected, ?string $customUserId): void
    {
        $this->params->expects(self::once())
            ->method('getCustomUserId')
            ->willReturn($customUserId);

        if (!$okExpected) {
            $this->expectException(InvalidArgumentException::class);
        }

        $this->validator->validateCustomUserIdRequired();

        if ($okExpected) {
            self::assertTrue(true);
        }
    }

    /**
     * @return array
     */
    public function validateCustomUserIdRequiredProvider(): array
    {
        return [
            'Empty string' => [false, ''],
            'Not set' => [false, null],

            'String zero' => [true, '0'],
            'Some non-empty' => [true, '100500'],
            'Caret' => [true, "\n"],
            'Tab' => [true, "\t"],
            'Space' => [true, ' '],
        ];
    }
}
