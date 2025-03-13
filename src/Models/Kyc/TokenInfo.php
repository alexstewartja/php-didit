<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Traits\Arrayable;

class TokenInfo
{
    use Arrayable;

    private ?int $expires_in = null;

    private ?string $access_token = null;

    public function getExpiresIn(): ?int
    {
        return $this->expires_in;
    }

    public function getAccessToken(): ?string
    {
        return $this->access_token;
    }
}
