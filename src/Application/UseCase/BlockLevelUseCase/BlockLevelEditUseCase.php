<?php

namespace Application\UseCase\BlockLevelUseCase;

use Application\DTO\BlockLevelsDTO;
use Domain\BlockLevelsRepositoryInterface;

class BlockLevelEditUseCase
{
    private BlockLevelsRepositoryInterface $blockLevelsRepository;
    public function __construct(BlockLevelsRepositoryInterface $blockLevelsRepository)
    {
        $this->blockLevelsRepository = $blockLevelsRepository;
    }
    public function execute(BlockLevelsDTO $blockLevels): int
    {
        return $this->blockLevelsRepository->edit($blockLevels);
    }
}