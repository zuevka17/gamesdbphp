<?php

namespace Domain\Entities;

class BasketballLevels
{
    private int $id;
    private int $pass_score;
    private float $time_for_level;
    private string $level_type;

    public function __construct(
        int $id,
        int $pass_score,
        float $time_for_level,
        string $level_type
    )
    {
        $this->id = $id;
        $this->pass_score = $pass_score;
        $this->time_for_level = $time_for_level;
        $this->level_type = $level_type;
    }

    public function createFromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['pass_score'] ?? null,
            $data['time_for_level'] ?? null,
            $data['level_type'] ?? null
        );
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getPassScore(): int
    {
        return $this->pass_score;
    }
    public function setPassScore(int $pass_score): void
    {
        $this->pass_score = $pass_score;
    }
    public function getTimeForLevel(): float
    {
        return $this->time_for_level;
    }
    public function setTimeForLevel(float $time_for_level): void
    {
        $this->time_for_level = $time_for_level;
    }
    public function getLevelType(): string
    {
        return $this->level_type;
    }
    public function setLevelType(string $level_type): void
    {
        $this->level_type = $level_type;
    }
}
