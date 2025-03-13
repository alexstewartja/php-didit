<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Models\Kyc\SessionAml\SessionAml;
use AlexStewartJa\Didit\Models\Kyc\SessionFace\SessionFace;
use AlexStewartJa\Didit\Models\Kyc\SessionLocation\SessionLocation;
use AlexStewartJa\Didit\Temporal\DiditExtendedDateTime;
use AlexStewartJa\Didit\Traits\Arrayable;

class Session
{
    use Arrayable;

    private ?string $session_id = null;

    private ?int $session_number = null;

    private ?string $session_token = null;

    private ?string $session_url = null;

    private ?string $url = null;

    private ?string $status = null;

    private ?string $vendor_data = null;

    private ?string $callback = null;

    private ?string $features = null;

    private ?SessionKyc $kyc = null;

    private ?SessionAml $aml = null;

    private ?SessionFace $face = null;

    private ?SessionLocation $location = null;

    /**
     * @var SessionWarning[]
     */
    private array $warnings = [];

    private ?string $user_href = null;

    /**
     * @var SessionReview[]
     */
    private array $reviews = [];

    private array $extra_images = [];

    private ?DiditExtendedDateTime $created_at = null;

    public function getClassListMappings(): array
    {
        return [
            'warnings' => SessionWarning::class,
            'reviews' => SessionReview::class,
        ];
    }

    public function isApproved(): bool
    {
        return $this->status === VerificationStatus::APPROVED;
    }

    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    public function getSessionNumber(): ?int
    {
        return $this->session_number;
    }

    public function getSessionToken(): ?string
    {
        return $this->session_token;
    }

    public function getSessionUrl(): ?string
    {
        return $this->session_url ?: $this->url;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getVendorData(): string
    {
        return $this->vendor_data;
    }

    public function setVendorData(string $vendor_data): void
    {
        $this->vendor_data = $vendor_data;
    }

    public function getCallback(): string
    {
        return $this->callback;
    }

    public function setCallback(string $callback): void
    {
        $this->callback = $callback;
    }

    public function getFeatures(): string
    {
        return $this->features;
    }

    public function setFeatures(string $features): void
    {
        $this->features = $features;
    }

    public function getKyc(): ?SessionKyc
    {
        return $this->kyc;
    }

    public function getAml(): ?SessionAml
    {
        return $this->aml;
    }

    public function getFace(): ?SessionFace
    {
        return $this->face;
    }

    public function getLocation(): ?SessionLocation
    {
        return $this->location;
    }

    public function getWarnings(): ?array
    {
        return $this->warnings;
    }

    public function getUserHref(): ?string
    {
        return $this->user_href;
    }

    public function getReviews(): ?array
    {
        return $this->reviews;
    }

    public function getExtraImages(): ?array
    {
        return $this->extra_images;
    }

    public function getCreatedAt(): ?DiditExtendedDateTime
    {
        return $this->created_at;
    }
}
