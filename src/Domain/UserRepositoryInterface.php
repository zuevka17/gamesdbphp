<?php

namespace Domain;

use Application\DTO\UserDTO;

interface UserRepositoryInterface
{
    public function add(UserDTO $userGamesDTO): UserDTO;
    public function remove(int $id): void;
    public function edit(UserDTO $userGamesDTO) : int;
    public function getById(int $id): UserDTO;
    public function getAll(): array;
}