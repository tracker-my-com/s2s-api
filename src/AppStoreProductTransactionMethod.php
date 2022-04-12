<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\SingleMethod;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\AppStoreProductTransactionMethod\{Params, ParamsValidator};

/**
 * App store product transaction command implementation
 */
final class AppStoreProductTransactionMethod extends SingleMethod
{
    /** @var string appStoreProductTransaction method name */
    private const URI = 'appStoreProductTransaction';

    /** @var Params */
    protected Params $params;

    /**
     * AppStoreProductTransactionMethod constructor.
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
