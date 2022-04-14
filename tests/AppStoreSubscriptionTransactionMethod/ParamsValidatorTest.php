<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod;

use Mycom\Tracker\S2S\Api\Common\Introductory;
use Mycom\Tracker\S2S\Api\Common\Trial;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod\Params;
use Mycom\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod\ParamsValidator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod\ParamsValidator
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
            'price not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'productId' => 'productId'
                ]),
                'error' => 'price param is required',
            ],
            'price negative number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => -1,
                    'currency' => 'rub',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                ]),
                'error' => 'price must be positive number',
            ],
            'price positive int number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'rub',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                ]),
                'error' => null,
            ],
            'price positive float number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 2.5,
                    'currency' => 'rub',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                ]),
                'error' => null,
            ],
            'currency not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                ]),
                'error' => 'currency param is required',
            ],
            'currency empty string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => '',
                ]),
                'error' => 'currency param is required',
            ],
            'currency small string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'R',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                ]),
                'error' => 'currency must be 3 character code',
            ],
            'currency big string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'RUSSIAN RUBLE',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                ]),
                'error' => 'currency must be 3 character code',
            ],
            'transactionIdOriginal not set' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                ]),
                'error' => 'transactionIdOriginal param is required',
            ],
            'transactionIdOriginal empty string' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => '',
                ]),
                'error' => 'transactionIdOriginal param is required',
            ],
            'isTrial big number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'isTrial' => 2,
                ]),
                'error' => 'isTrial must be COMMON or TRIAL',
            ],
            'isTrial small number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'isTrial' => -1,
                ]),
                'error' => 'isTrial must be COMMON or TRIAL',
            ],
            'isTrial correct number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'isTrial' => Trial::COMMON,
                ]),
                'error' => null,
            ],
            'isIntroductory big number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'isIntroductory' => 2,
                ]),
                'error' => 'isIntroductory must be REGULAR or INTRODUCTORY',
            ],
            'isIntroductory small number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'isIntroductory' => -1,
                ]),
                'error' => 'isIntroductory must be REGULAR or INTRODUCTORY',
            ],
            'isIntroductory correct number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'isIntroductory' => Introductory::REGULAR,
                ]),
                'error' => null,
            ],
            'tsPaymentOriginal small number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'tsPaymentOriginal' => -123,
                ]),
                'error' => 'tsPaymentOriginal must be positive number',
            ],
            'tsPaymentExpires small number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'USD',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'tsPaymentExpires' => -123,
                ]),
                'error' => 'tsPaymentExpires must be positive number',
            ],
            'quantity negative number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'rub',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'quantity' => -1,
                ]),
                'error' => 'quantity must be positive number',
            ],
            'quantity positive number' => [
                'params' => $createParams([
                    'transactionId' => 'transactionId',
                    'orderId' => 'orderId',
                    'productId' => 'productId',
                    'price' => 5,
                    'currency' => 'rub',
                    'transactionIdOriginal' => 'transactionIdOriginal',
                    'quantity' => 1,
                ]),
                'error' => null,
            ],
        ];
    }
}
