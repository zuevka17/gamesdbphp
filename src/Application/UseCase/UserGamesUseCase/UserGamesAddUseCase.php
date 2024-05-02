<?php

namespace Application\UseCase\UserGamesUseCase;

use Application\DTO\UserGamesDTO;
use Domain\Entities\UserGames;
use Domain\UserGamesRepositoryInterface;

class UserGamesAddUseCase
{
    private UserGamesRepositoryInterface $userGamesRepository;
    public function __construct(UserGamesRepositoryInterface $userGamesRepository)
    {
        $this->userGamesRepository = $userGamesRepository;
    }
    public function execute(UserGamesDTO $userGames): UserGamesDTO
    {
        return $this->userGamesRepository->add($userGames);
    }
}