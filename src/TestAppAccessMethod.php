<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\{Method, MethodInterface};
use Mycom\Tracker\S2S\Api\Common\Credentials;

/**
 * Method for test your credentials
 */
final class TestAppAccessMethod extends Method implements MethodInterface
{
    /** @var string Custom event command name */
    private static $URI = 'test-app-access';

    /** @var Credentials */
    private $credentials;

    /** @var int */
    private $idApp;

    /**
     * CheckAppAccessMethod constructor.
     *
     * @param Credentials $credentials
     * @param int $idApp
     */
    public function __construct(Credentials $credentials, int $idApp)
    {
        parent::__construct(self::$URI);

        $this->credentials = $credentials;
        $this->idApp = $idApp;
    }

    /** @inheritDoc */
    public function getRequestOptions(): array
    {
        return [
            RequestOptions::HEADERS => [
                Client\ClientInterface::AUTH_HEADER_NAME => $this->credentials->getToken(),
            ],
            RequestOptions::QUERY => [
                'idApp' => $this->idApp,
            ],
            RequestOptions::JSON => true,
        ];
    }
}
