<?php


namespace Component\Application\User\UseCases;



use Component\Domain\DTO\UserDTO;
use Component\Domain\Repository\UserRepository;

class UpdateUserUseCase
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserDTO $userDTO)
    {

        //return $this->repository->update($user->getId(),'',$user->getDateCreate());
    }
}