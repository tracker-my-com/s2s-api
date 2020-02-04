<?php declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

/**
 * Provides myTracker s2s api method.
 */
interface MethodInterface
{
    /**
     * Validate method parameters before call.
     * @return void
     */
    public function validate();

    /**
     * Get method uri
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Get method request options
     *
     * @return array
     */
    public function getRequestOptions(): array;
}
