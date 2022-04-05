<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod\Params;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod\ParamsValidator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod\ParamsValidator
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
            'subscriptionId not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                ]),
                'error' => 'subscriptionId param is required',
            ],
            'subscriptionId empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'subscriptionId' => ''
                ]),
                'error' => 'subscriptionId param is required',
            ],
            'token not set' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'subscriptionId' => 'subscriptionId',
                ]),
                'error' => 'token param is required',
            ],
            'token empty string' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'subscriptionId' => 'subscriptionId',
                    'token' => '',
                ]),
                'error' => 'token param is required',
            ],
            'subscriptionPeriod wrong string format' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'subscriptionId' => 'subscriptionId',
                    'token' => 'token',
                    'subscriptionPeriod' => 'subscriptionPeriod',
                ]),
                'error' => 'subscriptionPeriod param should be in ISO 8601 format',
            ],
            'subscriptionPeriod wrong date format' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'subscriptionId' => 'subscriptionId',
                    'token' => 'token',
                    'subscriptionPeriod' => '1W',
                ]),
                'error' => 'subscriptionPeriod param should be in ISO 8601 format',
            ],
            'subscriptionPeriod correct format' => [
                'params' => $createParams([
                    'orderId' => 'orderId',
                    'subscriptionId' => 'subscriptionId',
                    'token' => 'token',
                    'subscriptionPeriod' => 'P1W',
                ]),
                'error' => null,
            ]
        ];
    }
}
