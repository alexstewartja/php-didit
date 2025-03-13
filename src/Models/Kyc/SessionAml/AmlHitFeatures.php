<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionAml;

use AlexStewartJa\Didit\Traits\Arrayable;

class AmlHitFeatures
{
    use Arrayable;

    private ?float $person_name_jaro_winkler = null;

    private ?float $person_name_phonetic_match = null;

    public function getPersonNameJaroWinkler(): ?float
    {
        return $this->person_name_jaro_winkler;
    }

    public function getPersonNamePhoneticMatch(): ?float
    {
        return $this->person_name_phonetic_match;
    }
}
