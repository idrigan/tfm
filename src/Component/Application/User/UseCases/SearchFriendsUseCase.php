<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserDTO;
use Component\Domain\DTO\UserFriendDTO;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserMusicalTastesRepository;
use Doctrine\ORM\EntityManager;
use Component\Domain\Repository\FriendRepository;

class SearchFriendsUseCase
{
    private $repository;
    private $musicalTasteRepository;
    private $em;

    public function __construct(FriendRepository $repository,UserMusicalTastesRepository $userMusicalTastes,EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->musicalTasteRepository = $userMusicalTastes;
    }

    public function execute( $idUser,String $value){

        if (empty($idUser) || $idUser == null){
            return FALSE;
        }

        $data = $this->repository->searchFriends($idUser,$value);

        $result = array();

        if (count($data) > 0) {

            foreach ($data as $u) {
                $result[] = $u;
            }
        }

        return $result;

    }
}