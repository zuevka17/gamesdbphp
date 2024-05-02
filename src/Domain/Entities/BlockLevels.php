<?php

namespace Domain\Entities;

class BlockLevels
{
    private int $id;
    private int $solvable_steps;
    private string $grid_tiles;

    public function __construct(
        int $id,
        int $solvable_steps,
        string $grid_tiles,
    )
    {
        $this->id = $id;
        $this->solvable_steps = $solvable_steps;
        $this->grid_tiles = $grid_tiles;
    }

    public function createFromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['solvable_steps'] ?? null,
            $data['grid_tiles'] ?? null
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
    public function getSsolvableSteps(): int
    {
        return $this->solvable_steps;
    }
    public function setSolvableSteps(int $solvable_steps): void
    {
        $this->solvable_steps = $solvable_steps;
    }
    public function getGridTiles(): string
    {
        return $this->grid_tiles;
    }
    public function setGridTiles(string $grid_tiles): void
    {
        $this->grid_tiles = $grid_tiles;
    }
}