<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\Params;
use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ParamsValidator;
use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ProductItemParams;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ParamsValidatorTest extends TestCase
{
    public static function validParamsProvider(): array
    {
        $params = self::createValidParams();

        return [[$params]];
    }

    private static function createValidParams(): Params
    {
        $params = new Params();
        $params->orderId = '12345';
        $params->currencyCode = 'USD';
        $params->actionTs = '1650000000';
        $params->items = [self::createValidProductItem()];

        return $params;
    }

    private static function createValidProductItem(): ProductItemParams
    {
        $item = new ProductItemParams();
        $item->itemId = 'item1';
        $item->itemName = 'Product 1';
        $item->price = 100;
        $item->quantity = 1;
        $item->discount = 0;
        $item->tax = 20;
        $item->index = 0;

        return $item;
    }

    public static function invalidParamsProvider(): array
    {
        $baseParams = self::createValidParams();

        return [
            'missing orderId' => [
                self::modifyParams($baseParams, ['orderId' => null]),
                'order_id param is required'
            ],
            'invalid currencyCode' => [
                self::modifyParams($baseParams, ['currencyCode' => 'US']),
                'currency_code must be a 3-letter alphabetic code'
            ],
            'invalid timestamp' => [
                self::modifyParams($baseParams, ['actionTs' => 'invalid_ts']),
                'action_ts must be a valid numeric timestamp'
            ],
            'empty items array' => [
                self::modifyParams($baseParams, ['items' => []]),
                'items array must contain at least one product item'
            ],
        ];
    }

    private static function modifyParams(Params $params, array $modifications): Params
    {
        $modifiedParams = clone $params;

        foreach ($modifications as $property => $value) {
            $modifiedParams->$property = $value;
        }

        return $modifiedParams;
    }

    /**
     * @dataProvider validParamsProvider
     */
    public function testValidateSuccess(Params $params): void
    {
        $validator = new ParamsValidator($params);

        $this->expectNotToPerformAssertions();
        $validator->validate();
    }

    /**
     * @dataProvider invalidParamsProvider
     */
    public function testValidateFailure(Params $params, string $expectedExceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $validator = new ParamsValidator($params);
        $validator->validate();
    }
}
