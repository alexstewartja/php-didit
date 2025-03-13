<?php

namespace AlexStewartJa\Didit\Temporal;

use AlexStewartJa\Didit\Env;

class DiditExtendedDateTime extends \AlexStewartJa\Didit\Temporal\DateTime
{
    public static function ofString(string $dateTimeString): ?self
    {
        return self::createFromFormat(Env::EXTENDED_DATETIME_FORMAT, $dateTimeString);
    }

    public static function asString(\AlexStewartJa\Didit\Temporal\DateTime $dateTime): string
    {
        return $dateTime->format(Env::EXTENDED_DATETIME_FORMAT);
    }
}
