<?php

namespace AlexStewartJa\Didit\Temporal;

abstract class DateTime extends \DateTime
{
    public static function ofString(string $dateTimeString): ?self
    {
        return null;
    }

    public static function asString(DateTime $dateTime): string
    {
        return '';
    }
}
