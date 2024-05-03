<?php

namespace Domain;

use Application\DTO\HistoryDTO;

interface HistoryRepositoryInterface
{
    public function add(HistoryDTO $blockLevelsDTO): HistoryDTO;
    public function getByUserId(int $id): array;
    public function getAll(): array;
}