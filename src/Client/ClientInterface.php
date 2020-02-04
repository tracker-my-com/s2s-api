<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

use Psr\Http\Message\ResponseInterface;

/**
 * Represents an myTracker s2s api client
 */
interface ClientInterface
{
    /** @var string Auth header name */
    const AUTH_HEADER_NAME = 'Authorization';

    /**
     * @param MethodInterface $method
     *
     * @return ResponseInterface
     */
    public function request(MethodInterface $method): ResponseInterface;
}
