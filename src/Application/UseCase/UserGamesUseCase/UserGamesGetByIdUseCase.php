<?php

namespace Application\UseCase\UserGamesUseCase;

use Application\DTO\UserGamesDTO;
use Domain\Entities\UserGames;
use Domain\UserGamesRepositoryInterface;

class UserGamesGetByIdUseCase
{
    private UserGamesRepositoryInterface $userGamesRepository;
    public function __construct(UserGamesRepositoryInterface $userGamesRepository)
    {
        $this->userGamesRepository = $userGamesRepository;
    }
    public function execute(int $id): UserGamesDTO
    {
        return $this->userGamesRepository->getById($id);
    }
}