<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserDTO;
use Component\Domain\Repository\UserRepository;

class GetUserUseCase
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserDTO $user){
        return $this->repository->getUser($user->getEmail());
    }
}