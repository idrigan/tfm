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

        $data = $this->repository->searchFriendsByMusicalTaste($idUser,$value);

        $result = array();

        foreach ($data as $u) {
            $result[] = $u;
        }

        return $result;
    }
}