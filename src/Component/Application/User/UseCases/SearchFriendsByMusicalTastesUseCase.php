<?php


namespace Component\Application\User\UseCases;


use Component\Domain\Repository\UserMusicalTastesRepository;

class SearchFriendsByMusicalTastesUseCase
{
    private $repository;

    public function __construct(UserMusicalTastesRepository $repository)
    {
        $this->repository = $repository;

    }

    public function execute($idUser, String $value){

        if (empty($idUser) || $idUser == null){
            return FALSE;
        }

        $data = $this->repository->searchFriendsByMusicalTaste($idUser,$value);

        $result = array();

        if (count($data) > 0) {
            foreach ($data as $u) {
                $result[] = $u;
            }
        }

        return $result;
    }
}