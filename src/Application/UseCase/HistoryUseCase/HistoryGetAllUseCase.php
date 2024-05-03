<?php

namespace Application\UseCase\HistoryUseCase;

use Application\DTO\HistoryDTO;
use Domain\HistoryRepositoryInterface;

class HistoryGetAllUseCase
{
    private HistoryRepositoryInterface $historyRepository;
    public function __construct(HistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }
    public function execute(): array
    {
        return $this->historyRepository->getAll();
    }
}