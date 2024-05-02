<?php

namespace Application\UseCase\BasketballLevelUseCase;

use Application\DTO\BasketballLevelsDTO;
use Domain\BasketballLevelsRepositoryInterface;

class BasketBallAddUseCase
{
    private BasketballLevelsRepositoryInterface $basketballLevelsRepository;
    public function __construct(BasketballLevelsRepositoryInterface $basketballLevelsRepository)
    {
        $this->basketballLevelsRepository = $basketballLevelsRepository;
    }
    public function execute(BasketballLevelsDTO $basketballLevels): void
    {
        $this->basketballLevelsRepository->add($basketballLevels);
    }
}