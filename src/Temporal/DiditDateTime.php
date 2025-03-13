<?php

namespace AlexStewartJa\Didit\Temporal;

use AlexStewartJa\Didit\Env;

class DiditDateTime extends \AlexStewartJa\Didit\Temporal\DateTime
{
    public static function ofString(string $dateTimeString): ?DiditDateTime
    {
        return self::createFromFormat(Env::DATETIME_FORMAT, $dateTimeString);
    }

    public static function asString(\AlexStewartJa\Didit\Temporal\DateTime $dateTime): string
    {
        return $dateTime->format(Env::DATETIME_FORMAT);
    }
}
