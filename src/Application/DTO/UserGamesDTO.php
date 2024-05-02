<?php

namespace Application\DTO;

class UserGamesDTO implements \JsonSerializable
{
    public int $id;
    public int $game_id;
    public int $user_id;
    public int $result;



    public function __construct(
        ?int $id, 
        ?int $game_id, 
        ?int $user_id,
        ?int $result
    )
    {
        $this->id = $id;
        $this->game_id = $game_id;
        $this->user_id = $user_id;
        $this->result = $result;
    }
    public function jsonSerialize(): array
    {   
        return[
            "id"=> $this->id,
            "game_id"=> $this->game_id,
            "user_id"=> $this->user_id,
            "result"=> $this->result
        ];
    }
}