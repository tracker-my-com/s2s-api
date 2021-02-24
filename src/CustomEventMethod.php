<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\{ClientInterface, Method};
use Mycom\Tracker\S2S\Api\Common\Credentials;
use Mycom\Tracker\S2S\Api\CustomEventMethod\{Params, ParamsInterface, ParamsValidator};

/**
 * Custom event command implementation
 */
final class CustomEventMethod extends Method
{
    /** @var string Custom event command name */
    private const URI = 'customEvent';

    /** @var Credentials */
    private Credentials $credentials;

    /** @var int */
    private int $idApp;

    /** @var Params */
    private Params $params;

    /** @var ParamsValidator */
    private ParamsValidator $validator;

    /**
     * CustomEvent constructor.
     *
     * @param Credentials $credentials
     * @param int         $idApp
     */
    public function __construct(Credentials $credentials, int $idApp)
    {
        parent::__construct(self::URI);

        $this->credentials = $credentials;
        $this->idApp = $idApp;
        $this->params = new Params();
        $this->validator = new ParamsValidator($this->params);
    }

    /** @inheritDoc */
    public function validate(): void
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
