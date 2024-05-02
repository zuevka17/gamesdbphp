<?php

namespace Application\UseCase\BlockLevelUseCase;

use Application\DTO\BlockLevelsDTO;
use Domain\BlockLevelsRepositoryInterface;
use Domain\Entities\BlockLevels;

class BlockLevelAddUseCase
{
    private BlockLevelsRepositoryInterface $blockLevelsRepository;
    public function __construct(BlockLevelsRepositoryInterface $blockLevelsRepository)
    {
        $this->blockLevelsRepository = $blockLevelsRepository;
    }
    public function execute(BlockLevelsDTO $blockLevels): BlockLevelsDTO
    {
        return $this->blockLevelsRepository->add($blockLevels);
    }
}