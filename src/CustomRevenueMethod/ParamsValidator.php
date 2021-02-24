<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Class ParamsValidator
 */
final class ParamsValidator
{
    /** @var ParamsInterface */
    private ParamsInterface $params;

    /**
     * ParamsValidator constructor.
     *
     * @param ParamsInterface $params
     */
    public function __construct(ParamsInterface $params)
    {
        $this->params = $params;
    }

    /**
     * Validate what all customRevenueParam required params was set and it was correctly
     *
     * @throws InvalidArgumentException
     */
    public function validate(): void
    {
        $idTransaction = $this->params->getIdTransaction();
        if ($idTransaction === null || $idTransaction === '') {
            throw new InvalidArgumentException('idTransaction param is required');
        }

        if (strlen($idTransaction) > 255) {
            throw new InvalidArgumentException('idTransaction expected to be below 255');
        }

        $currency = $this->params->getCurrency();
        if ($currency === null || $currency === '') {
            throw new InvalidArgumentException('currency param is required');
        }

        if (strlen($currency) !== 3) {
            throw new InvalidArgumentException('currency must be 3 character code');
        }

        $total = $this->params->getTotal();
        if (is_null($total)) {
            throw new InvalidArgumentException('total param is required');
        }

        if ($total < 0.0) {
            throw new InvalidArgumentException('total must be positive number');
        }
    }
}
