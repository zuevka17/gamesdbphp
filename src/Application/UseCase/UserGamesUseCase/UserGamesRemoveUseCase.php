<?php

namespace Application\UseCase\UserGamesUseCase;

use Domain\UserGamesRepositoryInterface;

class UserGamesRemoveUseCase
{
    private UserGamesRepositoryInterface $userGamesRepository;
    public function __construct(UserGamesRepositoryInterface $userGamesRepository)
    {
        $this->userGamesRepository = $userGamesRepository;
    }
    public function execute(int $id): void
    {
        $this->userGamesRepository->remove($id);
    }
}