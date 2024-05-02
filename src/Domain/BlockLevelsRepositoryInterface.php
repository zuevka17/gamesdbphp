<?php

namespace Domain;
use Application\DTO\BlockLevelsDTO;
use Domain\Entities\BlockLevels;

interface BlockLevelsRepositoryInterface
{
    public function add(BlockLevelsDTO $blockLevelsDTO): BlockLevelsDTO;
    public function remove(int $id): void;
    public function edit(BlockLevelsDTO $blockLevelsDTO) : int;
    public function getById(int $id): BlockLevelsDTO;
    public function getAll(): array;
}