<?php

namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserFriendDTO;
use Component\Domain\Entity\UserFriend;
use Component\Domain\Repository\FriendRepository;
use Component\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class AddFriendUseCase
{
    private $repository;
    private $userRepository;
    private $em;

    public function __construct(FriendRepository $repository,UserRepository $userRepository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function execute(UserFriendDTO $userFriendDTO){

        $friends = $userFriendDTO->getFriends();
        $date = new \DateTime();
        $date->format("Y-m-d H:i:s");

        foreach ($friends as $row) {

            //check exist User
            $friend = $this->userRepository->getById($row->getId());

            if ($friend == null || empty($friend->getId())){
                return FALSE;
            }

            $userFriend = $this->repository->getUserFriend($userFriendDTO->getIdUser(),$friend->getId());

            if ($userFriend == null){
                //$idUser,$idUserFriend,$date
                $user = $this->userRepository->getById($userFriendDTO->getIdUser());
                $userFriend = new UserFriend($user,$friend,$date);
                $userFriend->setCancelled(false);


            }else {
                $userFriend->setAccepted(true);
                $userFriend->setDateCreate($date);
                $userFriend->setCancelled(false);
            }
            //$userFriend = new UserFriend($user,$friend,$date,TRUE);

            $this->repository->addFriend($userFriend);
        }
        $this->em->flush();
        $this->em->clear();

        return TRUE;

    }
}