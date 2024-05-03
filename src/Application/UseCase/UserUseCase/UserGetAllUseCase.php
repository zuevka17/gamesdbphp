<?php

namespace Application\UseCase\UserUseCase;

use Application\DTO\UserDTO;
use Domain\UserRepositoryInterface;

class UserGetAllUseCase
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute(): array
    {
        return $this->userRepository->getAll();
    }
}