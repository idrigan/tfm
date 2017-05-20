<?php


namespace Component\Application\User\UseCases;


use LoginBundle\Resources\config\doctrine\User;
use Component\Domain\Repository\UserRepository;

class CreateUserUseCase
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(User $user)
    {
        return $this->repository->create($user);
    }
}