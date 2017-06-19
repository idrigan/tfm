<?php

namespace Component\Application\User\UseCases;


use Component\Domain\DTO\MusicalTasteDTO;
use Component\Domain\DTO\MusicalTastesDTO;
use Component\Domain\Entity\MusicalTaste;
use Component\Domain\Entity\UserMusicalTaste;
use Component\Domain\Repository\MusicalTastesRepository;
use Doctrine\ORM\EntityManager;

class GetAllMusicalTastesUseCase
{
    private $repository;
    private $em;

    public function __construct(MusicalTastesRepository $repository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function execute($idUser){

        $musicalTastesDTO = new MusicalTastesDTO();

        foreach ($this->repository->getAllMusicalTastes($idUser) as $element){

            $musicalTaste = new MusicalTaste($element['id'],$element['name'],$element['description']);

            $musicalTasteDTO = new MusicalTasteDTO($musicalTaste,$element['b_checked']);

            $musicalTastesDTO->addMusicalTaste($musicalTasteDTO);
        }
        return $musicalTastesDTO;
    }
}