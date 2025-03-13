<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionLocation;

use AlexStewartJa\Didit\Traits\Arrayable;

class GeoLocation
{
    use Arrayable;

    private ?float $latitude = null;

    private ?float $longitude = null;

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
}
