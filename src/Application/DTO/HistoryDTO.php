<?php

namespace Application\DTO;

class HistoryDTO implements \JsonSerializable
{
    public ?int $id;
    public ?int $user_id;
    public ?int $game_id;
    public ?int $result;


    public function __construct(
        ?int $id,
        ?int $user_id,
        ?int $game_id,
        ?int $result
    )
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->game_id = $game_id;
        $this->result = $result;
    }
    public function jsonSerialize(): array
    {   
        return[
            "id"=> $this->id,
            "user_id"=> $this->user_id,
            "game_id"=> $this->game_id,
            "score"=> $this->result
        ];
    }
}