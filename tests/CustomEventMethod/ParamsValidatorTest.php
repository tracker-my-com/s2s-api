<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomEventMethod;

use Mycom\Tracker\S2S\Api\CustomEventMethod\{Params, ParamsValidator};
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\CustomEventMethod\ParamsValidator
 */
class ParamsValidatorTest extends TestCase
{

    /**
     * @covers ::validate
     * @dataProvider providerValidate
     *
     * @param string|null $customEventName
     * @param string|null $expectError
     *
     * @return void
     */
    public function testValidate(?string $customEventName, ?string $expectError): void
    {
        try {
            $params = new Params();
            $params->customEventName = $customEventName;

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
                'customEventName' => '',
                'expectError' => 'customEventName param is required',
            ],
            'Not set' => [
                'customEventName' => null,
                'expectError' => 'customEventName param is required',
            ],
            'String zero' => [
                'customEventName' => '0',
                'expectError' => null,
            ],
            'Some non-empty' => [
                'customEventName' => '100500',
                'expectError' => null,
            ],
            'Caret' => [
                'customEventName' => "\n",
                'expectError' => null,
            ],
            'Tab' => [
                'customEventName' => "\t",
                'expectError' => null,
            ],
            'Space' => [
                'customEventName' => ' ',
                'expectError' => null,
            ],
        ];
    }
}
