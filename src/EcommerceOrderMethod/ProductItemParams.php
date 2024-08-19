<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\EcommerceOrderMethod;

/**
 * Represents a single product item in an ecommerce order
 */
class ProductItemParams
{
    /**
     * Unique identifier of the product item
     *
     * @var string|null
     */
    public ?string $itemId = null;

    /**
     * Name of the product item
     *
     * @var string|null
     */
    public ?string $itemName = null;

    /**
     * Affiliation or store name where the item was purchased
     *
     * @var string|null
     */
    public ?string $affiliation = null;

    /**
     * Price of the product item
     *
     * @var float|null
     */
    public ?float $price = null;

    /**
     * Discount applied to the product item
     *
     * @var float|null
     */
    public ?float $discount = null;

    /**
     * Tax applied to the product item
     *
     * @var float|null
     */
    public ?float $tax = null;

    /**
     * Index or position of the product item
     *
     * @var int|null
     */
    public ?int $index = null;

    /**
     * Brand of the product item
     *
     * @var string|null
     */
    public ?string $itemBrand = null;

    /**
     * Variant of the product item
     *
     * @var string|null
     */
    public ?string $itemVariant = null;

    /**
     * Identifier of the list where the product item was displayed
     *
     * @var string|null
     */
    public ?string $itemListId = null;

    /**
     * Name of the list where the product item was displayed
     *
     * @var string|null
     */
    public ?string $itemListName = null;

    /**
     * Category 1 of the product item
     *
     * @var string|null
     */
    public ?string $itemCategory1 = null;

    /**
     * Category 2 of the product item
     *
     * @var string|null
     */
    public ?string $itemCategory2 = null;

    /**
     * Category 3 of the product item
     *
     * @var string|null
     */
    public ?string $itemCategory3 = null;

    /**
     * Category 4 of the product item
     *
     * @var string|null
     */
    public ?string $itemCategory4 = null;

    /**
     * Identifier of the location where the item was purchased
     *
     * @var string|null
     */
    public ?string $locationId = null;

    /**
     * Quantity of the product item
     *
     * @var int|null
     */
    public ?int $quantity = null;
}
