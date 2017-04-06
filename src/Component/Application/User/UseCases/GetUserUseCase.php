<?php


namespace Component\Application\User\UseCases;


use Component\Domain\Repository\UserRepository;

class GetUserUseCase
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(String $email){
        return $this->repository->getUser($email);
    }
}