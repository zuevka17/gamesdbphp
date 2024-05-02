<?php

namespace Domain;
use Application\DTO\UserGamesDTO;
use Domain\Entities\UserGames;

interface UserGamesRepositoryInterface
{
    public function add(UserGamesDTO $userGamesDTO): UserGamesDTO;
    public function remove(int $id): void;
    public function edit(UserGamesDTO $userGamesDTO) : int;
    public function getById(int $id): UserGamesDTO;
    public function getAll(): array;
}