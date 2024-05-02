<?php

namespace Domain\Entities;

class UserGames
{
    private int $id;
    private int $game_id;
    private int  $user;
    private int $result;


    public function __construct(
        int $id,
        int $game_id,
        string $user,
        int $result
    )
    {
        $this->id = $id;
        $this->game_id = $game_id;
        $this->user = $user;
        $this->result = $result;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'game_id'=> $this->game_id,
            'user_name'=> $this->user,
            'score'=> $this->result
        ];
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['game_id'] ?? null,
            $data['user'] ?? null,
            $data['result'] ?? null
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
    public function getGameId(): int
    {
        return $this->game_id;
    }
    public function setGameId(int $game_id): void
    {
        $this->game_id = $game_id;
    }
    public function getUserName(): string
    {
        return $this->user;
    }
    public function setUserName(string $user): void
    {
        $this->user = $user;
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