<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * Provides access to myTracker s2s api
 */
interface CredentialsInterface
{
    /**
     * Returns the myTracker account s2s token for this credentials object.
     *
     * @return string
     */
    public function getToken(): string;
}
