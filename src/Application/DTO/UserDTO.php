<?php

namespace Application\DTO;

class UserDTO implements \JsonSerializable
{
    public ?int $id;
    public ?string $name;
    public function __construct(
        ?int $id, 
        ?string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function jsonSerialize(): array
    {
        return[
            "id"=> $this->id,
            "name"=> $this->name
        ];
    }
}