<?php

namespace Application\UseCase\BasketballLevelUseCase;

use Application\DTO\BasketballLevelsDTO;
use Domain\BasketballLevelsRepositoryInterface;

class BasketBallEditUseCase
{
    private BasketballLevelsRepositoryInterface $basketBallEditRepository;
    public function __construct(BasketballLevelsRepositoryInterface $basketBallEditRepository)
    {
        $this->basketBallEditRepository = $basketBallEditRepository;
    }
    public function execute(BasketballLevelsDTO $basketballLevels): int
    {
        return $this->basketBallEditRepository->edit($basketballLevels);
    }
}