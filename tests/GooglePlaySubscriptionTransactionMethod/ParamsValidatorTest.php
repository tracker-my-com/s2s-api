<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod\Params;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod\ParamsValidator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod\ParamsValidator
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
            'priceCurrencyCode not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                ]),
                'error' => 'priceCurrencyCode param is required',
            ],
            'priceCurrencyCode empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => '',
                ]),
                'error' => 'priceCurrencyCode param is required',
            ],
            'priceCurrencyCode small string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceAmountMicros' => 100500,
                    'subscriptionId' => 'subscriptionId',
                    'priceCurrencyCode' => 'R',
                ]),
                'error' => 'priceCurrencyCode must be 3 character code',
            ],
            'priceCurrencyCode big string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceAmountMicros' => 100500,
                    'subscriptionId' => 'subscriptionId',
                    'priceCurrencyCode' => 'RUSSIAN RUBLE',
                ]),
                'error' => 'priceCurrencyCode must be 3 character code',
            ],
            'priceAmountMicros not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                ]),
                'error' => 'priceAmountMicros param is required',
            ],
            'priceAmountMicros negative number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => -1342,
                    'subscriptionId' => 'subscriptionId',
                ]),
                'error' => 'priceAmountMicros must be positive number',
            ],
            'priceAmountMicros positive number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                ]),
                'error' => null,
            ],
            'subscriptionId not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                ]),
                'error' => 'subscriptionId param is required',
            ],
            'subscriptionId empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => ''
                ]),
                'error' => 'subscriptionId param is required',
            ],
            'paymentState no number string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'paymentState' => 'paymentState'
                ]),
                'error' => 'paymentState must be string with number',
            ],
            'paymentState big number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'paymentState' => '3'
                ]),
                'error' => 'paymentState must be 1 or 2',
            ],
            'paymentState small number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'paymentState' => '-1'
                ]),
                'error' => 'paymentState must be 1 or 2',
            ],
            'paymentState correct number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'paymentState' => '1'
                ]),
                'error' => null,
            ],
            'isIntroductory big number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'isIntroductory' => 3
                ]),
                'error' => 'isIntroductory must be 0 or 1',
            ],
            'isIntroductory small number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'isIntroductory' => -1
                ]),
                'error' => 'isIntroductory must be 0 or 1',
            ],
            'isIntroductory correct number' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'priceCurrencyCode' => 'RUB',
                    'priceAmountMicros' => 1990000,
                    'subscriptionId' => 'subscriptionId',
                    'isIntroductory' => 0
                ]),
                'error' => null,
            ]
        ];
    }
}
