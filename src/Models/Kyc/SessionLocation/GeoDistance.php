<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionLocation;

use AlexStewartJa\Didit\Traits\Arrayable;

class GeoDistance
{
    use Arrayable;

    private ?float $distance = null;

    private ?string $direction = null;

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }
}
