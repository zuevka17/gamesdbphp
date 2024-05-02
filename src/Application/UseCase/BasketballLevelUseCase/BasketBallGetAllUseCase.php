<?php

namespace Application\UseCase\BasketballLevelUseCase;

use Domain\BasketballLevelsRepositoryInterface;

class BasketBallGetAllUseCase
{
    private BasketballLevelsRepositoryInterface $basketballLevelsRepository;
    public function __construct(BasketballLevelsRepositoryInterface $basketballLevelsRepository)
    {
        $this->basketballLevelsRepository = $basketballLevelsRepository;
    }
    public function execute() : array
    {
        return $this->basketballLevelsRepository->getAll();
    }
}