<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\Params;
use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ProductItemParams;
use PHPUnit\Framework\TestCase;

final class ParamsTest extends TestCase
{
    public static function paramsDefaultValuesProvider(): array
    {
        return [
            ['orderId'],
            ['status'],
            ['currencyCode'],
            ['actionId'],
            ['actionTs'],
            ['coupon'],
            ['items'],
        ];
    }

    public static function paramsSetterGetterProvider(): array
    {
        return [
            ['orderId', '12345'],
            ['status', 'completed'],
            ['currencyCode', 'USD'],
            ['actionId', 'action123'],
            ['actionTs', '2024-08-16T12:34:56Z'],
            ['coupon', 'DISCOUNT10'],
            ['items', [new ProductItemParams(), new ProductItemParams()]],
        ];
    }

    /**
     * @dataProvider paramsDefaultValuesProvider
     */
    public function testParamsDefaultValues($property): void
    {
        $params = new Params();

        $this->assertNull($params->$property, "Expected '$property' to be null by default.");
    }

    /**
     * @dataProvider paramsSetterGetterProvider
     */
    public function testSetAndGetProperties($property, $value): void
    {
        $params = new Params();
        $params->$property = $value;

        $this->assertSame($value, $params->$property, "Expected '$property' to return the value that was set.");
    }
}
