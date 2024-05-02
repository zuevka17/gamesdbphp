<?php

namespace Domain;
use Application\DTO\BasketballLevelsDTO;
use Domain\Entities\BasketballLevels;


interface BasketballLevelsRepositoryInterface
{
    public function add(BasketballLevelsDTO $basketballLevels): BasketballLevelsDTO;
    public function remove(int $id): void;
    public function edit(BasketballLevelsDTO $basketballLevels) : int;
    public function getById(int $id): BasketballLevelsDTO;
    public function getAll(): array;
}