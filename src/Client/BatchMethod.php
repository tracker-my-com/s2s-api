<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Common\BaseParams;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Base class for batch methods
 */
abstract class BatchMethod implements MethodInterface
{
    /** @var CredentialsInterface */
    private CredentialsInterface $credentials;

    /** @var string Command name */
    private string $uri;

    /** @var int */
    private int $idApp;

    /** @var array */
    protected array $batch = [];

    /**
     * BatchMethod constructor.
     *
     * @param string               $uri
     * @param CredentialsInterface $credentials
     * @param int                  $idApp
     */
    public function __construct(string $uri, CredentialsInterface $credentials, int $idApp)
    {
        $this->uri = $uri;
        $this->credentials = $credentials;
        $this->idApp = $idApp;
    }

    /**
     * Add new params to batch
     *
     * @return BaseParams
     */
    abstract public function addParams(): BaseParams;


    /** @inheritDoc */
    public function validate(): void
    {
        if (empty($this->batch)) {
            throw new InvalidArgumentException('Empty params batch');
        }

        if (\count($this->batch) > 20) {
            throw new InvalidArgumentException('Batch expected to be below 20');
        }
    }

    /** @inheritDoc */
    public function getUri(): string
    {
        return $this->uri;
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
            RequestOptions::JSON => \array_map(static fn(BaseParams $params): array => $params->toArray(), $this->batch),
        ];
    }
}
