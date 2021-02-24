<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParamsInterface;

/**
 * Represents custom event params
 */
interface ParamsInterface extends BaseParamsInterface
{
    /**
     * Set ID of the transaction in the client's system.
     *
     * @param string $idTransaction Transaction identifier, 1-255 characters, example: order1234
     *
     * @return $this
     */
    public function setIdTransaction(string $idTransaction): self;

    /**
     * Get current revenue transaction identifier
     *
     * @return string|null
     */
    public function getIdTransaction(): ?string;

    /**
     * Set transaction currency code in ISO-4217
     *
     * @param string $currency Transaction currency, 3 characters, example: USD
     *
     * @return $this
     */
    public function setCurrency(string $currency): self;

    /**
     * Get current revenue currency code
     *
     * @return string|null
     */
    public function getCurrency(): ?string;

    /**
     * Set amount of transaction
     *
     * @param float $total Transaction total, 4-digit precision, example: 1.99
     *
     * @return $this
     */
    public function setTotal(float $total): self;

    /**
     * Get current revenue total value
     *
     * @return float|null
     */
    public function getTotal(): ?float;
}
