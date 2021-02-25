<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\UserEventMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\UserEventMethod\{Params, ParamsValidator};
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\UserEventMethod\ParamsValidator
 */
class ParamsValidatorTest extends TestCase
{
    /**
     * @covers ::validate
     * @dataProvider providerValidate
     *
     * @param string|null $customUserId
     * @param string|null $expectError
     *
     * @return void
     */
    public function testValidate(?string $customUserId, ?string $expectError): void
    {
        try {
            $params = new Params();
            $params->customUserId = $customUserId;

            $validator = new ParamsValidator($params);
            $validator->validate();
            self::assertNull($expectError);
        } catch (InvalidArgumentException $exception) {
            self::assertEquals($expectError, $exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function providerValidate(): array
    {
        return [
            'Empty string' => [
                'customUserId' => '',
                'expectError' => 'customUserId param is required',
            ],
            'Not set' => [
                'customUserId' => null,
                'expectError' => 'customUserId param is required',
            ],
            'String zero' => [
                'customUserId' => '0',
                'expectError' => null,
            ],
            'Some non-empty' => [
                'customUserId' => '100500',
                'expectError' => null,
            ],
            'Caret' => [
                'customUserId' => "\n",
                'expectError' => null,
            ],
            'Tab' => [
                'customUserId' => "\t",
                'expectError' => null,
            ],
            'Space' => [
                'customUserId' => ' ',
                'expectError' => null,
            ],
        ];
    }
}
