<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\{ClientInterface, Method};
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\CustomRevenueMethod\{Params, ParamsValidator};
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;

/**
 * Custom revenue batch method implementation
 */
final class CustomRevenueBatchMethod extends Method
{
    /** @var string Custom revenue batch method name */
    private const URI = 'customRevenueBatch';

    /** @var CredentialsInterface */
    private CredentialsInterface $credentials;

    /** @var int */
    private int $idApp;

    /** @var Params[] */
    private array $batch = [];


    /**
     * CustomRevenueBatchMethod constructor.
     *
     * @param CredentialsInterface $credentials
     * @param int                  $idApp
     */
    public function __construct(CredentialsInterface $credentials, int $idApp)
    {
        parent::__construct(self::URI);

        $this->credentials = $credentials;
        $this->idApp = $idApp;
    }

    /**
     * Add new params to batch
     *
     * @return Params
     */
    public function addParams(): Params
    {
        $params = new Params();
        $this->batch[] = $params;

        return $params;
    }

    /** @inheritDoc */
    public function validate(): void
    {
        if (empty($this->batch)) {
            throw new InvalidArgumentException('Empty params batch');
        }

        if (\count($this->batch) > 20) {
            throw new InvalidArgumentException('Batch expected to be below 20');
        }

        foreach ($this->batch as $param) {
            (new ParamsValidator($param))->validate();
        }
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
            RequestOptions::JSON => \array_map(static fn(Params $params): array => $params->toArray(), $this->batch),
        ];
    }
}
