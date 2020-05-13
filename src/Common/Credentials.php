<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * Default myTracker s2s api client credentials implementation
 */
final class Credentials implements CredentialsInterface
{
    /** @var string myTracker app token */
    private $token;

    /**
     * Credentials constructor.
     * @see https://tracker.my.com/docs/api how to get s2s token
     *
     * @param string $token myTracker app token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /** @inheritDoc */
    public function getToken(): string
    {
        return $this->token;
    }
}
