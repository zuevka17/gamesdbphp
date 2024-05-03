<?php

namespace Application\UseCase\UserUseCase;

use Application\DTO\UserDTO;
use Domain\UserRepositoryInterface;

class UserEditUseCase
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute(UserDTO $user): int
    {
        return $this->userRepository->edit($user);
    }
}