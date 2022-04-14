<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\SingleMethod;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\AppStoreSubscriptionTransactionMethod\{Params, ParamsValidator};

/**
 * App store subscription transaction command implementation
 */
final class AppStoreSubscriptionTransactionMethod extends SingleMethod
{
    /** @var string appStoreSubscriptionTransaction method name */
    private const URI = 'appStoreSubscriptionTransaction';

    /** @var Params */
    protected Params $params;

    /**
     * AppStoreSubscriptionTransactionMethod constructor.
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
