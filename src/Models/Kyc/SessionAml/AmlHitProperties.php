<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionAml;

use AlexStewartJa\Didit\Traits\Arrayable;

class AmlHitProperties
{
    use Arrayable;

    /**
     * @var string[]|null
     */
    private ?array $name = null;

    /**
     * @var string[]|null
     */
    private ?array $alias = null;

    /**
     * @var string[]|null
     */
    private ?array $notes = null;

    /**
     * @var string[]|null
     */
    private ?array $gender = null;

    /**
     * @var string[]|null
     */
    private ?array $topics = null;

    /**
     * @var string[]|null
     */
    private ?array $position = null;

    public function getName(): ?array
    {
        return $this->name;
    }

    public function getAlias(): ?array
    {
        return $this->alias;
    }

    public function getNotes(): ?array
    {
        return $this->notes;
    }

    public function getGender(): ?array
    {
        return $this->gender;
    }

    public function getTopics(): ?array
    {
        return $this->topics;
    }

    public function getPosition(): ?array
    {
        return $this->position;
    }
}
