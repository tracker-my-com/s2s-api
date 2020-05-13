<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

use Mycom\Tracker\S2S\Api\Exception\ExceptionInterface;
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
     * @throws ExceptionInterface
     */
    public function request(MethodInterface $method): ResponseInterface;
}
