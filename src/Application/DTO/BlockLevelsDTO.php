<?php

namespace Application\DTO;

class BlockLevelsDTO implements \JsonSerializable
{
    public ?int $id;
    public ?int $solvable_steps;
    public ?string $grid_tiles;

    public function __construct(
        ?int $id, 
        ?int $solvable_steps, 
        ?string $grid_tiles
    )
    {
        $this->id = $id;
        $this->solvable_steps = $solvable_steps;
        $this->grid_tiles = $grid_tiles;
    }
    public function jsonSerialize(): array
    {   
        return[
            "id"=> $this->id,
            "solvable_steps"=> $this->solvable_steps,
            "grid_tiles"=> $this->grid_tiles
        ];
    }
}