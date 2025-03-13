<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionAml;

use AlexStewartJa\Didit\Temporal\DiditDateTime;
use AlexStewartJa\Didit\Traits\Arrayable;

class AmlHit
{
    use Arrayable;

    private ?string $id = null;

    private ?bool $match = null;

    private ?float $score = null;

    private ?bool $target = null;

    private ?string $caption = null;

    /**
     * @var string[]|null
     */
    private ?array $datasets = null;

    private ?AmlHitFeatures $features = null;

    private ?DiditDateTime $last_seen = null;

    private ?DiditDateTime $first_seen = null;

    private ?AmlHitProperties $properties = null;

    private ?DiditDateTime $last_change;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMatch(): ?bool
    {
        return $this->match;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function getTarget(): ?bool
    {
        return $this->target;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function getDatasets(): ?array
    {
        return $this->datasets;
    }

    public function getFeatures(): ?AmlHitFeatures
    {
        return $this->features;
    }

    public function getLastSeen(): ?DiditDateTime
    {
        return $this->last_seen;
    }

    public function getFirstSeen(): ?DiditDateTime
    {
        return $this->first_seen;
    }

    public function getProperties(): ?AmlHitProperties
    {
        return $this->properties;
    }

    public function getLastChange(): ?DiditDateTime
    {
        return $this->last_change;
    }
}
