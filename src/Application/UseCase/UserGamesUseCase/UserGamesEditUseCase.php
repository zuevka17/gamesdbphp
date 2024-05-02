<?php

namespace Application\UseCase\UserGamesUseCase;

use Application\DTO\UserGamesDTO;
use Domain\UserGamesRepositoryInterface;

class UserGamesEditUseCase
{
    private UserGamesRepositoryInterface $userGamesRepository;
    public function __construct(UserGamesRepositoryInterface $userGamesRepository)
    {
        $this->userGamesRepository = $userGamesRepository;
    }
    public function execute(UserGamesDTO $userGames): int
    {
        return $this->userGamesRepository->edit($userGames);
    }
}