<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\CustomRevenueMethod\{Params, ParamsValidator};
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\CustomRevenueMethod\ParamsValidator
 */
class ParamsValidatorTest extends TestCase
{
    /**
     * @covers ::validate
     * @dataProvider providerValidate
     *
     * @param Params      $params
     * @param string|null $error
     */
    public function testValidate(Params $params, string $error = null): void
    {
        try {
            (new ParamsValidator($params))->validate();
            self::assertEmpty($error);
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
            'idTransaction not set' => [
                'params' => $createParams([]),
                'error' => 'idTransaction param is required',
            ],
            'idTransaction empty string' => [
                'params' => $createParams([
                    'idTransaction' => '',
                ]),
                'error' => 'idTransaction param is required',
            ],
            'idTransaction too long string' => [
                'params' => $createParams([
                    'idTransaction' => \str_repeat('t', 256),
                ]),
                'error' => 'idTransaction expected to be below 255',
            ],
            'currency not set' => [
                'params' => $createParams([
                    'idTransaction' => 'idTransaction',
                ]),
                'error' => 'currency param is required',
            ],
            'currency empty string' => [
                'params' => $createParams([
                    'idTransaction' => 'idTransaction',
                    'currency' => '',
                ]),
                'error' => 'currency param is required',
            ],
            'currency big string' => [
                'params' => $createParams([
                    'idTransaction' => 'idTransaction',
                    'currency' => 'some',
                ]),
                'error' => 'currency must be 3 character code',
            ],
            'total not set' => [
                'params' => $createParams([
                    'idTransaction' => 'idTransaction',
                    'currency' => 'RUB',
                ]),
                'error' => 'total param is required',
            ],
            'total is zero' => [
                'params' => $createParams([
                    'idTransaction' => 'idTransaction',
                    'currency' => 'RUB',
                    'total' => 0,
                ]),
                'error' => null,
            ],
            'all correct' => [
                'params' => $createParams([
                    'idTransaction' => 'idTransaction',
                    'currency' => 'RUB',
                    'total' => 12.33434,
                ]),
                'error' => null,
            ],
        ];
    }
}
