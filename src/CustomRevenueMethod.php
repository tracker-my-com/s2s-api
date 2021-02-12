<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\{ClientInterface, Method};
use Mycom\Tracker\S2S\Api\Common\Credentials;
use Mycom\Tracker\S2S\Api\CustomRevenueMethod\{Params, ParamsInterface, ParamsValidator};

/**
 * Custom revenue command implementation
 */
final class CustomRevenueMethod extends Method
{
    /** @var string Custom event command name */
    private static $URI = 'customRevenue';

    /** @var Credentials */
    private $credentials;

    /** @var int */
    private $idApp;

    /** @var ParamsInterface */
    private $params;

    /** @var ParamsValidator */
    private $validator;

    /**
     * CustomEvent constructor.
     *
     * @param Credentials $credentials
     * @param int $idApp
     */
    public function __construct(Credentials $credentials, int $idApp)
    {
        parent::__construct(self::$URI);

        $this->credentials = $credentials;
        $this->idApp = $idApp;
        $this->params = new Params();
        $this->validator = new ParamsValidator($this->params);
    }

    /** @inheritDoc */
    public function validate()
    {
        $this->validator->validate();
    }

    /**
     * Return event params object
     *
     * @return ParamsInterface
     */
    public function params(): ParamsInterface
    {
        return $this->params;
    }

    /** @inheritDoc */
    public function getRequestOptions(): array
    {
        return [
            RequestOptions::HEADERS => [
                ClientInterface::AUTH_HEADER_NAME => $this->credentials->getToken(),
            ],
            RequestOptions::QUERY => [
                'idApp' => $this->idApp,
            ],
            RequestOptions::JSON => $this->params->toArray(),
        ];
    }
}
