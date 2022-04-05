<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\SingleMethod;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\GooglePlayProductTransactionMethod\{Params, ParamsValidator};

/**
 * Google play product transaction command implementation
 */
final class GooglePlayProductTransactionMethod extends SingleMethod
{
    /** @var string googlePlayProductTransaction method name */
    private const URI = 'googlePlayProductTransaction';

    /** @var Params */
    protected Params $params;

    /**
     * GooglePlayProductTransactionMethod constructor.
     *
     * @param CredentialsInterface $credentials
     * @param int                  $idApp
     */
    public function __construct(CredentialsInterface $credentials, int $idApp)
    {
        $this->params = new Params();
        $validator = new ParamsValidator($this->params);
        parent::__construct(self::URI, $credentials, $idApp, $validator);
    }

    /** @inheritDoc */
    public function params(): Params
    {
        return $this->params;
    }
}
