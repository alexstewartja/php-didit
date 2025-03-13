<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Traits\Arrayable;

class SessionWarning
{
    use Arrayable;

    private ?string $feature = null;

    private ?string $risk = null;

    private ?array $additional_data = null;

    private ?string $log_type = null;

    private ?string $short_description = null;

    private ?string $long_description = null;

    public function getFeature(): ?string
    {
        return $this->feature;
    }

    public function getRisk(): ?string
    {
        return $this->risk;
    }

    public function getAdditionalData(): ?array
    {
        return $this->additional_data;
    }

    public function getLogType(): ?string
    {
        return $this->log_type;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }
}
