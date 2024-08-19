<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\EcommerceOrderMethod;

use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ProductItemParams;
use PHPUnit\Framework\TestCase;

final class ProductItemParamsTest extends TestCase
{
    public static function productItemParamsDefaultValuesProvider(): array
    {
        return [
            ['itemId'],
            ['itemName'],
            ['affiliation'],
            ['price'],
            ['discount'],
            ['tax'],
            ['index'],
            ['itemBrand'],
            ['itemVariant'],
            ['itemListId'],
            ['itemListName'],
            ['itemCategory1'],
            ['itemCategory2'],
            ['itemCategory3'],
            ['itemCategory4'],
            ['locationId'],
            ['quantity'],
        ];
    }

    public static function valueProvider(): array
    {
        return [
            ['itemId', 'item123'],
            ['itemName', 'Test Product'],
            ['affiliation', 'Test Store'],
            ['price', 99.99],
            ['discount', 5.0],
            ['tax', 8.25],
            ['index', 1],
            ['itemBrand', 'Test Brand'],
            ['itemVariant', 'Red'],
            ['itemListId', 'list123'],
            ['itemListName', 'Best Products'],
            ['itemCategory1', 'Electronics'],
            ['itemCategory2', 'Phones'],
            ['itemCategory3', 'Smartphones'],
            ['itemCategory4', 'Flagships'],
            ['locationId', 'loc123'],
            ['quantity', 3],
        ];
    }

    public static function nullablePropertiesProvider(): array
    {
        return [
            ['itemId'],
            ['price'],
            ['index'],
            ['quantity'],
        ];
    }

    /**
     * @dataProvider productItemParamsDefaultValuesProvider
     */
    public function testProductItemParamsDefaultValues($property): void
    {
        $params = new ProductItemParams();

        $this->assertNull($params->$property, "Expected '$property' to be null by default.");
    }

    /**
     * @dataProvider valueProvider
     */
    public function testSettingValues(string $property, $value): void
    {
        $item = new ProductItemParams();
        $item->$property = $value;

        $this->assertSame($value, $item->$property);
    }

    /**
     * @dataProvider nullablePropertiesProvider
     */
    public function testNullableProperties(string $property): void
    {
        $item = new ProductItemParams();
        $item->$property = null;

        $this->assertNull($item->$property);
    }
}
