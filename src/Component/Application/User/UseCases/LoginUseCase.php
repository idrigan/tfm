<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\ResponseDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManager;


class LoginUseCase
{
    private $repository;
    private $em;

    public function __construct(UserRepository $repository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function execute(UserDTO $userDTO){

        $user = $this->repository->getUser($userDTO->getEmail());

        $date = new \DateTime();
        $date->format("Y-m-d H:i:s");

        if ($user == null){

            $user = new User($userDTO->getEmail(),$userDTO->getNick(),$date);

            $this->repository->create($user);

        }else{
            $user = $user[0];

            $this->repository->update($user->getId(),$user->getNick(),$date);
        }

        $this->em->flush();


        $data = array(
            'id'=>$user->getId(),
            'nick'=>$userDTO->getNick(),
            'email'=>$user->getEmail(),
            'locale'=>$userDTO->getLocale(),
            'picture'=>$userDTO->getPicture(),
            'name'=>$userDTO->getName()
        );

        return new ResponseDTO($data,"/home");

    }

}