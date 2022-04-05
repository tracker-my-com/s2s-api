<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Common\BaseParams;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\Validator\ValidatorInterface;

/**
 * Base class for single methods
 */
abstract class SingleMethod implements MethodInterface
{
    /** @var CredentialsInterface */
    private CredentialsInterface $credentials;

    /** @var string Command name */
    private string $uri;

    /** @var int */
    private int $idApp;

    /** @var ValidatorInterface */
    protected ValidatorInterface $validator;

    /**
     * SingleMethod constructor.
     *
     * @param string               $uri
     * @param CredentialsInterface $credentials
     * @param int                  $idApp
     * @param ValidatorInterface   $validator
     */
    public function __construct(string $uri, CredentialsInterface $credentials, int $idApp, ValidatorInterface $validator)
    {
        $this->uri = $uri;
        $this->credentials = $credentials;
        $this->idApp = $idApp;
        $this->validator = $validator;
    }

    /**
     * Return event params object
     *
     * @return BaseParams
     */
    abstract public function params(): BaseParams;

    /** @inheritDoc */
    public function validate(): void
    {
        $this->validator->validate();
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
            RequestOptions::JSON => $this->params()->toArray(),
        ];
    }

    /** @inheritDoc */
    public function getUri(): string
    {
        return $this->uri;
    }
}
