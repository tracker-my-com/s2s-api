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
     * @param Params      $params
     * @param string|null $error
     *
     * @return void
     */
    public function testValidate(Params $params, ?string $error): void
    {
        try {
            (new ParamsValidator($params))->validate();
            self::assertNull($error);
        } catch (InvalidArgumentException $exception) {
            self::assertEquals($error, $exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function providerValidate(): array
    {
        $createParams = static function (array $data): Params {
            $params = new Params();
            foreach ($data as $name => $value) {
                $params->$name = $value;
            }
            return $params;
        };

        return [
            'Empty string' => [
                'params' => $createParams([
                    'customEventName' => '',
                ]),
                'error' => 'customEventName param is required',
            ],
            'Not set' => [
                'params' => $createParams([
                    'customEventName' => null,
                ]),
                'error' => 'customEventName param is required',
            ],
            'String zero' => [
                'params' => $createParams([
                    'customEventName' => '0',
                ]),
                'error' => null,
            ],
            'Some non-empty' => [
                'params' => $createParams([
                    'customEventName' => '100500',
                ]),
                'error' => null,
            ],
            'Caret' => [
                'params' => $createParams([
                    'customEventName' => "\n",
                ]),
                'error' => null,
            ],
            'Tab' => [
                'params' => $createParams([
                    'customEventName' => "\t",
                ]),
                'error' => null,
            ],
            'Space' => [
                'params' => $createParams([
                    'customEventName' => ' ',
                ]),
                'error' => null,
            ],
            'empty event params' => [
                'params' => $createParams([
                    'customEventName' => 'test',
                    'customEventParams' => [],
                ]),
                'error' => null,
            ],
            'event params with number key' => [
                'params' => $createParams([
                    'customEventName' => 'test',
                    'customEventParams' => [1 => 'test'],
                ]),
                'error' => 'customEventParams key name must be a string',
            ],
            'event params with number value' => [
                'params' => $createParams([
                    'customEventName' => 'test',
                    'customEventParams' => ['test' => 1],
                ]),
                'error' => 'customEventParams key value must be a string',
            ],
            'event params with null key' => [
                'params' => $createParams([
                    'customEventName' => 'test',
                    'customEventParams' => [null => 'test'],
                ]),
                'error' => null, //null key cast to empty string
            ],
            'event params with null value' => [
                'params' => $createParams([
                    'customEventName' => 'test',
                    'customEventParams' => ['test' => null],
                ]),
                'error' => 'customEventParams key value must be a string',
            ],
        ];
    }
}
