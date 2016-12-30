<?php
declare(strict_types = 1);

namespace mheinzerling\commons;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static Separator WIN()
 * @method static Separator NS()
 * @method static Separator UNIX()
 */
class Separator extends AbstractEnumeration
{
    const WIN = "\\";
    const NS = "\\";
    const UNIX = "/";
}