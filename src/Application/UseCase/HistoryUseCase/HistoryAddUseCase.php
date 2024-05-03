<?php

namespace Application\UseCase\HistoryUseCase;

use Application\DTO\HistoryDTO;
use Domain\HistoryRepositoryInterface;

class HistoryAddUseCase
{
    private HistoryRepositoryInterface $historyRepository;
    public function __construct(HistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }
    public function execute(HistoryDTO $history): HistoryDTO
    {
        return $this->historyRepository->add($history);
    }
}