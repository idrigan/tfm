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
        if (empty($user->getEmail()) || $user->getEmail() == null){
            return FALSE;
        }

        if (!filter_var($user->getEmail(),FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }

        return $this->repository->getUser($user->getEmail());
    }

    public function getById(UserDTO $user){
        if (empty($user->getId()) || $user->getId() == null){
            return FALSE;
        }
        return $this->repository->getById($user->getId());
    }
}