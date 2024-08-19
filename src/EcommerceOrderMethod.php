<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\SingleMethod;
use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\Params;
use Mycom\Tracker\S2S\Api\EcommerceOrderMethod\ParamsValidator;

class EcommerceOrderMethod extends SingleMethod
{
    /** @var string ecommerceOrder method name */
    private const URI = 'order';
    /** @var Params */
    protected Params $params;

    /** @inheritDoc */
    public function __construct(CredentialsInterface $credentials, int $idApp)
    {
        $this->params = new Params();
        $validator = new ParamsValidator($this->params);
        parent::__construct(self::URI, $credentials, $idApp, $validator);
    }

    /**
     * @inheritDoc
     */
    public function params(): Params
    {
        return $this->params;
    }
}