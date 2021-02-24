<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Common\BaseParams;

/**
 * Represents custom event params
 */
final class Params extends BaseParams implements ParamsInterface
{
    /** @var string|null */
    protected ?string $idTransaction = null;

    /** @var string|null */
    protected ?string $currency = null;

    /** @var float|null */
    protected ?float $total = null;


    /**  @inheritDoc */
    public function setIdTransaction(string $idTransaction): self
    {
        $this->idTransaction = $idTransaction;

        return $this;
    }

    /** @inheritDoc */
    public function getIdTransaction(): ?string
    {
        return $this->idTransaction;
    }

    /**  @inheritDoc */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /** @inheritDoc */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**  @inheritDoc */
    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /** @inheritDoc */
    public function getTotal(): ?float
    {
        return $this->total;
    }
}
