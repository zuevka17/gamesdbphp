<?php

namespace Application\UseCase\BasketballLevelUseCase;

use Application\DTO\BasketballLevelsDTO;
use Application\Repositories\BasketballLevelsRepository;
use Domain\BasketballLevelsRepositoryInterface;
use Domain\Entities\BasketballLevels;

class BasketBalllGetByIdUseCase
{
    private BasketballLevelsRepositoryInterface $basketBalllRepository;

    public function __construct(BasketballLevelsRepositoryInterface $basketBalllRepository)
    {
        $this->basketBalllRepository = $basketBalllRepository;
    }
    public function execute(int $id): BasketballLevelsDTO
    {
        return $this->basketBalllRepository->getById($id);
    }
}