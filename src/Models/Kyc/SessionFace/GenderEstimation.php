<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionFace;

use AlexStewartJa\Didit\Traits\Arrayable;

class GenderEstimation
{
    use Arrayable;

    private ?float $male = null;

    private ?float $female = null;

    public function getMale(): ?float
    {
        return $this->male;
    }

    public function getFemale(): ?float
    {
        return $this->female;
    }

    public function isFemale(): bool
    {
        return ! $this->isMale();
    }

    public function isMale(): bool
    {
        return $this->male > $this->female;
    }
}
