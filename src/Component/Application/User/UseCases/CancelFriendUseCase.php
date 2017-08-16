<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserFriendDTO;
use Component\Domain\Repository\FriendRepository;
use Component\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class CancelFriendUseCase
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

            if (empty($friend->getId())){
                return FALSE;
            }

            $userFriend = $this->repository->getUserFriend($userFriendDTO->getIdUser(),$friend->getId());

            if ($userFriend == null){
                return FALSE;
            }
            $userFriend->setAccepted(false);
            $userFriend->setDateCreate($date);
            $userFriend->setCancelled(true);
            //$userFriend = new UserFriend($user,$friend,$date,TRUE);

            $this->repository->cancelFriend($userFriend);
        }
        $this->em->flush();
        $this->em->clear();

        return TRUE;

    }
}