<?php

namespace Application\UseCase\BlockLevelUseCase;

use Domain\BlockLevelsRepositoryInterface;

class BlockLevelGetAllUseCase
{
    private BlockLevelsRepositoryInterface $blockLevelsRepository;
    public function __construct(BlockLevelsRepositoryInterface $blockLevelsRepository)
    {
        $this->blockLevelsRepository = $blockLevelsRepository;
    }
    public function execute(): array
    {
        return $this->blockLevelsRepository->getAll();
    }
}