<?php

namespace AlexStewartJa\Didit\Traits;

class Constable
{
    public static function getConstants(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    public static function getKeys(): array
    {
        return array_keys(static::getConstants());
    }

    public static function getValues(): array
    {
        return array_values(static::getConstants());
    }
}
