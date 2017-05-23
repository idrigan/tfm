<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserRepository;

use DateTime;

class CreateUserUseCase
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserDTO $userDTO)
    {
      //  $em = $this->getDoctrine()->getManager();
        $date = new DateTime();
        $date->format("Y-m-d H:i:s");
        $user = new User($userDTO->getEmail(),$date);
        $this->repository->create($user);
      //  $em->flush();


    }
}