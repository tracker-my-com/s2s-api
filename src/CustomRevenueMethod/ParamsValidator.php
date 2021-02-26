<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Class ParamsValidator
 */
final class ParamsValidator
{
    /** @var Params */
    private Params $params;

    /**
     * ParamsValidator constructor.
     *
     * @param Params $params
     */
    public function __construct(Params $params)
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
        if (
            $this->params->idTransaction === null
            || $this->params->idTransaction === ''
        ) {
            throw new InvalidArgumentException('idTransaction param is required');
        }

        if (strlen($this->params->idTransaction) > 255) {
            throw new InvalidArgumentException('idTransaction expected to be below 255');
        }

        if (
            $this->params->currency === null
            || $this->params->currency === ''
        ) {
            throw new InvalidArgumentException('currency param is required');
        }

        if (strlen($this->params->currency) !== 3) {
            throw new InvalidArgumentException('currency must be 3 character code');
        }

        if ($this->params->total === null) {
            throw new InvalidArgumentException('total param is required');
        }

        if ($this->params->total < 0.0) {
            throw new InvalidArgumentException('total must be positive number');
        }
    }
}
