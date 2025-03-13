<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionFace;

use AlexStewartJa\Didit\Traits\Arrayable;

class SessionFace
{
    use Arrayable;

    private ?string $status = null;

    private ?string $face_match_status = null;

    private ?string $liveness_status = null;

    private ?float $face_match_similarity = null;

    private ?float $liveness_confidence = null;

    private ?string $source_image = null;

    private ?string $target_image = null;

    private ?string $video_url = null;

    private ?float $age_estimation = null;

    private ?GenderEstimation $gender_estimation = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getFaceMatchStatus(): ?string
    {
        return $this->face_match_status;
    }

    public function getLivenessStatus(): ?string
    {
        return $this->liveness_status;
    }

    public function getFaceMatchSimilarity(): ?float
    {
        return $this->face_match_similarity;
    }

    public function getLivenessConfidence(): ?float
    {
        return $this->liveness_confidence;
    }

    public function getSourceImage(): ?string
    {
        return $this->source_image;
    }

    public function getTargetImage(): ?string
    {
        return $this->target_image;
    }

    public function getVideoUrl(): ?string
    {
        return $this->video_url;
    }

    public function getAgeEstimation(): ?float
    {
        return $this->age_estimation;
    }

    public function getGenderEstimation(): ?GenderEstimation
    {
        return $this->gender_estimation;
    }
}
