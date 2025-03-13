<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Temporal\DiditExtendedDateTime;
use AlexStewartJa\Didit\Traits\Arrayable;

class SessionKyc
{
    use Arrayable;

    private ?string $status = null;

    private ?string $ocr_status = null;

    private ?string $epassport_status = null;

    private ?string $document_type = null;

    private ?string $document_number = null;

    private ?string $personal_number = null;

    private ?string $portrait_image = null;

    private ?string $front_image = null;

    private ?string $front_video = null;

    private ?string $back_image = null;

    private ?string $back_video = null;

    private ?string $full_front_image = null;

    private ?string $full_back_image = null;

    private ?string $date_of_birth = null;

    private ?string $expiration_date = null;

    private ?string $date_of_issue = null;

    private ?string $issuing_state = null;

    private ?string $issuing_state_name = null;

    private ?string $first_name = null;

    private ?string $last_name = null;

    private ?string $full_name = null;

    private ?string $gender = null;

    private ?string $address = null;

    private ?string $formatted_address = null;

    private ?bool $is_nfc_verified = null;

    private ?string $parsed_address = null;

    private ?string $place_of_birth = null;

    private ?string $marital_status = null;

    private ?string $nationality = null;

    private ?DiditExtendedDateTime $created_at = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getOcrStatus(): ?string
    {
        return $this->ocr_status;
    }

    public function getEpassportStatus(): ?string
    {
        return $this->epassport_status;
    }

    public function getDocumentType(): ?string
    {
        return $this->document_type;
    }

    public function getDocumentNumber(): ?string
    {
        return $this->document_number;
    }

    public function getPersonalNumber(): ?string
    {
        return $this->personal_number;
    }

    public function getPortraitImage(): ?string
    {
        return $this->portrait_image;
    }

    public function getFrontImage(): ?string
    {
        return $this->front_image;
    }

    public function getFrontVideo(): ?string
    {
        return $this->front_video;
    }

    public function getBackImage(): ?string
    {
        return $this->back_image;
    }

    public function getBackVideo(): ?string
    {
        return $this->back_video;
    }

    public function getFullFrontImage(): ?string
    {
        return $this->full_front_image;
    }

    public function getFullBackImage(): ?string
    {
        return $this->full_back_image;
    }

    public function getDateOfBirth(): ?string
    {
        return $this->date_of_birth;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    public function getDateOfIssue(): ?string
    {
        return $this->date_of_issue;
    }

    public function getIssuingState(): ?string
    {
        return $this->issuing_state;
    }

    public function getIssuingStateName(): ?string
    {
        return $this->issuing_state_name;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getFormattedAddress(): ?string
    {
        return $this->formatted_address;
    }

    public function getIsNfcVerified(): ?bool
    {
        return $this->is_nfc_verified;
    }

    public function getParsedAddress(): ?string
    {
        return $this->parsed_address;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->place_of_birth;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->marital_status;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function getCreatedAt(): ?DiditExtendedDateTime
    {
        return $this->created_at;
    }
}
