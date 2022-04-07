<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\SingleMethod;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod\{Params, ParamsValidator};

/**
 * Google play subscription transaction command implementation
 */
final class GooglePlaySubscriptionTransactionMethod extends SingleMethod
{
    /** @var string googlePlaySubscriptionTransaction method name */
    private const URI = 'googlePlaySubscriptionTransaction';

    /** @var Params */
    protected Params $params;

    /**
     * GooglePlaySubscriptionTransactionMethod constructor.
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
