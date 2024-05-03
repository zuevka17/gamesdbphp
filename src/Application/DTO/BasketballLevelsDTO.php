<?php

namespace Application\DTO;

class BasketballLevelsDTO implements \JsonSerializable
{
    public ?int $id;
    public ?int $pass_score;
    public ?int $time_for_level;
    public ?string $level_type;

    public function __construct(
        ?int $id, 
        ?int $pass_score, 
        ?int $time_for_level, 
        ?string $level_type
    )
    {
        $this->id = $id;
        $this->pass_score = $pass_score;
        $this->time_for_level = $time_for_level;
        $this->level_type = $level_type;
    }
    public function jsonSerialize(): array
    {   
        return[
            "id"=> $this->id,
            "pass_score"=> $this->pass_score,
            "time_for_level"=> $this->time_for_level,
            "level_type"=> $this->level_type
        ];
    }
}