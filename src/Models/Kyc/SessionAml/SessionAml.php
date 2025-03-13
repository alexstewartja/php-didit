<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionAml;

use AlexStewartJa\Didit\Traits\Arrayable;

class SessionAml
{
    use Arrayable;

    private ?string $status = null;

    private ?int $total_hits = null;

    private ?float $score = null;

    /**
     * @var AmlHit[]|null
     */
    private ?array $hits = null;

    public function getClassListMappings(): array
    {
        return [
            'hits' => AmlHit::class,
        ];
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getTotalHits(): ?int
    {
        return $this->total_hits;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function getHits(): ?array
    {
        return $this->hits;
    }
}
