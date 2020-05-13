<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Client;

/**
 * Basic command abstraction.
 */
abstract class Method implements MethodInterface
{
    /** @var string Command name */
    private $uri;

    /**
     * Command constructor.
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /** @inheritDoc */
    public function validate()
    {
        // do nothing by default
    }

    /** @inheritDoc */
    public function getUri(): string
    {
        return $this->uri;
    }

    /** @inheritDoc */
    public function getRequestOptions(): array
    {
        return [];
    }
}
