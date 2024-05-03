<?php

namespace Application\UseCase\UserUseCase;

use Application\DTO\UserDTO;
use Domain\UserRepositoryInterface;

class UserGetByIdUseCase
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute(int $id): UserDTO
    {
        return $this->userRepository->getById($id);
    }
}