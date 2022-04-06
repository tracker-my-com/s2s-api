<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\{BatchMethod};
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\GooglePlaySubscriptionTokenMethod\{Params, ParamsValidator};

/**
 * Google play subscription token batch command implementation
 */
final class GooglePlaySubscriptionTokenBatchMethod extends BatchMethod
{
    /** @var string method name */
    private const URI = 'googlePlaySubscriptionTokenBatch';

    /** @inheritDoc */
    public function __construct(CredentialsInterface $credentials, int $idApp)
    {
        parent::__construct(self::URI, $credentials, $idApp);
    }

    /** @inheritDoc */
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
