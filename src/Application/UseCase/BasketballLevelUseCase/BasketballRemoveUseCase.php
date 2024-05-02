<?php

namespace Application\UseCase\BasketballLevelUseCase;

use Domain\BasketballLevelsRepositoryInterface;

class BasketballRemoveUseCase
{
    public BasketballLevelsRepositoryInterface $BlockLevelsRepository;
    public function __construct(BasketballLevelsRepositoryInterface $blockLevelsRepository)
    {
        $this->BlockLevelsRepository = $blockLevelsRepository;
    }
    public function execute(int $id): void
    {
        $this->BlockLevelsRepository->remove($id);
    }
}