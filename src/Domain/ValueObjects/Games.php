<?php

namespace Domain\ValueObjects;

class Games
{
    private int $id;
    private int $game;

    public function __construct(
        int $id,
        int $game
    )
    {
        $this->id = $id;
        $this->game = $game;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getGame(): int
    {
        return $this->game;
    }
}