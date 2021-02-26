<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\{ClientInterface, Method};
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\UserEventMethod\{Params, ParamsValidator};

/**
 * Login command implementation
 */
final class LoginMethod extends Method
{
    /** @var string Login command name */
    private const URI = 'login';

    /** @var CredentialsInterface */
    private CredentialsInterface $credentials;

    /** @var int */
    private int $idApp;

    /** @var Params */
    private Params $params;

    /** @var ParamsValidator */
    private ParamsValidator $validator;

    /**
     * LoginMethod constructor.
     *
     * @param CredentialsInterface $credentials
     * @param int                  $idApp
     */
    public function __construct(CredentialsInterface $credentials, int $idApp)
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
     * @return Params
     */
    public function params(): Params
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
