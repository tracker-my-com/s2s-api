<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ProductItemParams;
use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ProductItemParamsValidator;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProductItemParamsValidatorTest extends TestCase
{
    public static function validParamsProvider(): array
    {
        return [
            [self::createValidProductItemParams()]
        ];
    }

    private static function createValidProductItemParams(): ProductItemParams
    {
        $params = new ProductItemParams();
        $params->itemId = 'item123';
        $params->itemName = 'Test Product';
        $params->price = 99.99;
        $params->quantity = 1;
        $params->discount = 5.0;
        $params->tax = 10.0;
        $params->index = 0;

        return $params;
    }

    public static function invalidParamsProvider(): array
    {
        $baseParams = self::createValidProductItemParams();

        return [
            'missing itemId' => [
                self::modifyProductItemParams($baseParams, ['itemId' => null]),
                'item_id param is required'
            ],
            'invalid price' => [
                self::modifyProductItemParams($baseParams, ['price' => -1]),
                'price must be between 0 and 10,000,000,000'
            ],
            'invalid discount' => [
                self::modifyProductItemParams($baseParams, ['discount' => 10_000_000_001]),
                'discount must be between 0 and 10,000,000,000'
            ],
            'invalid tax' => [
                self::modifyProductItemParams($baseParams, ['tax' => 101]),
                'tax must be between 0 and 100'
            ],
            'negative index' => [
                self::modifyProductItemParams($baseParams, ['index' => -1]),
                'index must be a non-negative integer'
            ],
            'invalid quantity' => [
                self::modifyProductItemParams($baseParams, ['quantity' => 0]),
                'quantity must be between 1 and 10,000,000,000'
            ],
        ];
    }

    private static function modifyProductItemParams(ProductItemParams $params, array $modifications): ProductItemParams
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
    public function testValidateSuccess(ProductItemParams $params): void
    {
        $validator = new ProductItemParamsValidator($params);

        $this->expectNotToPerformAssertions();
        $validator->validate();
    }

    /**
     * @dataProvider invalidParamsProvider
     */
    public function testValidateFailure(ProductItemParams $params, string $expectedExceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $validator = new ProductItemParamsValidator($params);
        $validator->validate();
    }
}
