<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserFriendDTO;
use Component\Domain\Repository\FriendRepository;
use Doctrine\ORM\EntityManager;

class FriendsUseCase
{
    private $repository;
    private $em;

   public function __construct(FriendRepository $repository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function execute(UserFriendDTO $userFriendDTO){

        $userFriendDTO->setFriends($this->repository->getFriendsByUser($userFriendDTO->getIdUser()));

        return $userFriendDTO;

    }
}