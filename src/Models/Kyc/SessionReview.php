<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Temporal\DiditExtendedDateTime;
use AlexStewartJa\Didit\Traits\Arrayable;

class SessionReview
{
    use Arrayable;

    private ?string $user = null;

    private ?string $new_status = null;

    private ?string $comment = null;

    private ?DiditExtendedDateTime $created_at = null;

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function getNewStatus(): ?string
    {
        return $this->new_status;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getCreatedAt(): ?DiditExtendedDateTime
    {
        return $this->created_at;
    }
}
