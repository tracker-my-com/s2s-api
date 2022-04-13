<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\AppStoreSubscriptionReceiptMethod;

use Mycom\Tracker\S2S\Api\AppStoreSubscriptionReceiptMethod\Params;
use Mycom\Tracker\S2S\Api\AppStoreSubscriptionReceiptMethod\ParamsValidator;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\AppStoreSubscriptionReceiptMethod\ParamsValidator
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
            'transactionId not set' => [
                'params' => $createParams([]),
                'error' => 'transactionId param is required',
            ],
            'transactionId empty string' => [
                'params' => $createParams([
                    'transactionId' => '',
                ]),
                'error' => 'transactionId param is required',
            ],
            'productId not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                ]),
                'error' => 'productId param is required',
            ],
            'productId empty string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => '',
                ]),
                'error' => 'productId param is required',
            ],
            'receipt not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                ]),
                'error' => 'receipt param is required',
            ],
            'receipt empty string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => '',
                ]),
                'error' => 'receipt param is required',
            ],
            'price not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'currency' => 'rub',
                ]),
                'error' => 'price param is required',
            ],
            'price negative number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'currency' => 'rub',
                    'price' => -1,
                ]),
                'error' => 'price must be positive number',
            ],
            'price positive int number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'currency' => 'rub',
                    'price' => 5,
                ]),
                'error' => null,
            ],
            'price positive float number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'currency' => 'rub',
                    'price' => 2.5,
                ]),
                'error' => null,
            ],
            'currency not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'price' => 2.5,
                ]),
                'error' => 'currency param is required',
            ],
            'currency empty string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'price' => 2.5,
                    'currency' => '',
                ]),
                'error' => 'currency param is required',
            ],
            'currency small string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'price' => 2.5,
                    'currency' => 'R',
                ]),
                'error' => 'currency must be 3 character code',
            ],
            'currency big string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId',
                    'receipt' => 'receipt',
                    'price' => 2.5,
                    'currency' => 'RUSSIAN RUBLE',
                ]),
                'error' => 'currency must be 3 character code',
            ],
        ];
    }
}
