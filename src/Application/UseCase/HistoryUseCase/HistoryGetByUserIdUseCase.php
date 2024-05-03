<?php

namespace Application\UseCase\HistoryUseCase;

use Application\DTO\HistoryDTO;
use Domain\HistoryRepositoryInterface;

class HistoryGetByUserIdUseCase
{
    private HistoryRepositoryInterface $historyRepository;
    public function __construct(HistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }
    public function execute(int $id): array
    {
        return $this->historyRepository->getByUserId($id);
    }
}