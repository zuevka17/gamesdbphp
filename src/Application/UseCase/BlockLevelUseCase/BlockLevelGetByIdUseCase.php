<?php

namespace Application\UseCase\BlockLevelUseCase;

use Application\DTO\BlockLevelsDTO;
use Domain\BlockLevelsRepositoryInterface;
use Domain\Entities\BlockLevels;

class BlockLevelGetByIdUseCase
{
    private BlockLevelsRepositoryInterface $blockLevelsRepository;
    public function __construct(BlockLevelsRepositoryInterface $blockLevelsRepository)
    {
        $this->blockLevelsRepository = $blockLevelsRepository;
    }
    public function execute(int $id): BlockLevelsDTO
    {
        return $this->blockLevelsRepository->getById($id);
    }
}