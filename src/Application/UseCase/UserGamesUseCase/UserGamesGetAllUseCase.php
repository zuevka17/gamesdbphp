<?php

namespace Application\UseCase\UserGamesUseCase;

use Domain\UserGamesRepositoryInterface;

class UserGamesGetAllUseCase
{
    private UserGamesRepositoryInterface $userGamesRepository;
    public function __construct(UserGamesRepositoryInterface $userGamesRepository)
    {
        $this->userGamesRepository = $userGamesRepository;
    }
    public function execute(): array
    {
        return $this->userGamesRepository->getAll();
    }
}