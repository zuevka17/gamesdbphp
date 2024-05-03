<?php

namespace Application\UseCase\UserUseCase;

use Application\DTO\UserDTO;
use Domain\UserRepositoryInterface;

class UserAddUseCase
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute(UserDTO $user): UserDTO
    {
        return $this->userRepository->add($user);
    }
}