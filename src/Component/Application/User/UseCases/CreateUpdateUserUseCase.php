<?php


namespace Component\Application\User\UseCases;


use Component\Domain\Entity\User;
use Component\Domain\Repository\UserRepository;

class CreateUpdateUserUseCase
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(User $user){

        $this->repository->createUser($user);
    }
}