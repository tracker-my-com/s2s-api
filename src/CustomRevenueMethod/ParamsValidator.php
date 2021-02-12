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
    private $params;

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
     * Validate is customEventName was set and not empty.
     *
     * @throws InvalidArgumentException
     */
    public function validate()
    {
        $idTransaction = $this->params->getIdTransaction();
        if (is_null($idTransaction) || 0 === strlen($idTransaction)) {
            throw new InvalidArgumentException('idTransaction param is required');
        }

        if (strlen($idTransaction) > 255) {
            throw new InvalidArgumentException('idTransaction expected to be below 255');
        }

        $currency = $this->params->getCurrency();
        if (is_null($currency) || 0 === strlen($currency)) {
            throw new InvalidArgumentException('currency param is required');
        }

        if (strlen($currency) !== 3) {
            throw new InvalidArgumentException('currency must be 3 character code');
        }

        $total = $this->params->getTotal();
        if (is_null($total)) {
            throw new InvalidArgumentException('total param is required');
        }

        if (!\is_numeric($total)) {
            throw new InvalidArgumentException('total must be number');
        }

        if ($total < 0.0) {
            throw new InvalidArgumentException('total must be positive number');
        }
    }
}
