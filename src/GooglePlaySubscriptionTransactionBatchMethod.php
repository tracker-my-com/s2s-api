<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\BatchMethod;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTransactionMethod\{Params, ParamsValidator};

/**
 * Google play subscription transaction batch command implementation
 */
final class GooglePlaySubscriptionTransactionBatchMethod extends BatchMethod
{
    /** @var string method name */
    private const URI = 'googlePlaySubscriptionTransactionBatch';

    /**
     * GooglePlaySubscriptionTransactionBatchMethod constructor.
     *
     * @param CredentialsInterface $credentials
     * @param int                  $idApp
     */
    public function __construct(CredentialsInterface $credentials, int $idApp)
    {
        parent::__construct(self::URI, $credentials, $idApp);
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
        parent::validate();
        foreach ($this->batch as $param) {
            (new ParamsValidator($param))->validate();
        }
    }
}
