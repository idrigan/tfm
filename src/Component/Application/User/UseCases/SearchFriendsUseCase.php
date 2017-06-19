<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserDTO;
use Component\Domain\DTO\UserFriendDTO;
use Component\Domain\Entity\User;
use Doctrine\ORM\EntityManager;
use Component\Domain\Repository\FriendRepository;

class SearchFriendsUseCase
{
    private $repository;
    private $em;

    public function __construct(FriendRepository $repository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function execute(int $idUser,String $value){

        $data = $this->repository->searchFriends($idUser,$value);

        $result = array();

        foreach ($data as $u) {
            $result[] = $u;
        }

        return $result;

    }
}