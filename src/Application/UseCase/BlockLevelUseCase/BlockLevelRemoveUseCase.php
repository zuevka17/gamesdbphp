<?php

namespace Application\UseCase\BlockLevelUseCase;

use Domain\BlockLevelsRepositoryInterface;

class BlockLevelRemoveUseCase
{
    private BlockLevelsRepositoryInterface $blockLevelsRepository;
    public function __construct(BlockLevelsRepositoryInterface $blockLevelsRepository)
    {
        $this->blockLevelsRepository = $blockLevelsRepository;
    }
    public function execute(int $id) : void
    {
        $this->blockLevelsRepository->remove($id);
    }
}