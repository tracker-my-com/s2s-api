<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\GooglePlayProductTransactionMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod\Params;
use Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod\ParamsValidator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod\ParamsValidator
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
            'orderId not set' => [
                'params' => $createParams([]),
                'error' => 'orderId param is required',
            ],
            'orderId empty string' => [
                'params' => $createParams([
                    'orderId' => '',
                ]),
                'error' => 'orderId param is required',
            ],
            'productId not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                ]),
                'error' => 'productId param is required',
            ],
            'productId empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => '',
                ]),
                'error' => 'productId param is required',
            ],
            'token not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId'
                ]),
                'error' => 'token param is required',
            ],
            'token empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => '',
                ]),
                'error' => 'token param is required',
            ],
            'currency not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                ]),
                'error' => 'currency param is required',
            ],
            'currency empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'currency' => '',
                ]),
                'error' => 'currency param is required',
            ],
            'currency small string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'revenue' => 10.0,
                    'currency' => 'R',
                ]),
                'error' => 'currency must be 3 character code',
            ],
            'currency big string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'revenue' => 10.0,
                    'currency' => 'RUSSIAN RUBLE',
                ]),
                'error' => 'currency must be 3 character code',
            ],
            'revenue not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'currency' => 'RUB',
                ]),
                'error' => 'revenue param is required',
            ],
            'revenue negative number float' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'currency' => 'RUB',
                    'revenue' => -13.1,
                ]),
                'error' => 'revenue must be positive number',
            ],
            'revenue negative number int' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'currency' => 'RUB',
                    'revenue' => -13,
                ]),
                'error' => 'revenue must be positive number',
            ],
            'revenue positive number float' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'currency' => 'RUB',
                    'revenue' => 10.5,
                ]),
                'error' => null,
            ],
            'revenue positive number int' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'token' => 'token',
                    'currency' => 'RUB',
                    'revenue' => 10,
                ]),
                'error' => null,
            ],
        ];
    }
}
