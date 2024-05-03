<?php

namespace Application\UseCase\UserUseCase;

use Domain\UserRepositoryInterface;

class UserRemoveUseCase
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute(int $id): void
    {
        return $this->userRepository->remove($id);
    }
}