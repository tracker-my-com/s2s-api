<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use GuzzleHttp\RequestOptions;
use Mycom\Tracker\S2S\Api\Client\{ClientInterface, Method, MethodInterface};
use Mycom\Tracker\S2S\Api\Common\Credentials;
use Mycom\Tracker\S2S\Api\CustomEventMethod\{Params, ParamsInterface};

/**
 * Custom event command implementation
 */
final class CustomEventMethod extends Method implements MethodInterface
{
    /** @var string Custom event command name */
    private static $URI = 'customEvent';

    /** @var Credentials */
    private $credentials;

    /** @var int */
    private $idApp;

    /** @var ParamsInterface */
    private $eventParams;

    /**
     * CustomEvent constructor.
     *
     * @param Credentials $credentials
     * @param int         $idApp
     */
    public function __construct(Credentials $credentials, int $idApp)
    {
        parent::__construct(self::$URI);

        $this->credentials = $credentials;
        $this->idApp = $idApp;
        $this->eventParams = new Params();
    }

    /**
     * Return event params object
     *
     * @return ParamsInterface
     */
    public function params(): ParamsInterface
    {
        return $this->eventParams;
    }

    /** @inheritDoc */
    public function validate()
    {
        //todo add validation
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
            RequestOptions::JSON => $this->eventParams->toArray(),
        ];
    }
}
