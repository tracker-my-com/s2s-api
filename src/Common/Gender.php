<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api\Common;

/**
 * Gender constants
 */
final class Gender
{
    /** @var int User's gender is unknown */
    public const UNKNOWN = 0;

    /** @var int User is male */
    public const MALE = 1;

    /** @var int User is female */
    public const FEMALE = 2;
}
