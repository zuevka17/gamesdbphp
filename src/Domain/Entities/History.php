<?php

namespace Domain\Entities;

class History
{
    private int $id;
    private int $user_id;
    private int $game_id;
    private int $result;

    public function __construct(
        int $id,
        int $user_id,
        int $game_id,
        int $result
    )
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->game_id = $game_id;
        $this->result = $result;
    }

    public function createFromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['user_id'] ?? null,
            $data['game_id'] ?? null,
            $data['score'] ?? null
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
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function getGameId(): int
    {
        return $this->game_id;
    }
    public function setGameId(int $game_id): void
    {
        $this->game_id = $game_id;
    }
    public function getResult(): int
    {
        return $this->result;
    }
    public function setResult(int $result): void
    {
        $this->result = $result;
    }
}