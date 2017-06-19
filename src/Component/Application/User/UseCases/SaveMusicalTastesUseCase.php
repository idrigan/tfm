<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\MusicalTastesDTO;
use Component\Domain\Entity\UserMusicalTaste;
use Component\Domain\Repository\MusicalTastesRepository;
use Component\Domain\Repository\UserMusicalTastesRepository;
use Component\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class SaveMusicalTastesUseCase
{
    private $repository;
    private $userRepository;
    private $musicalTastesRepository;
    private $em;

    public function __construct(UserMusicalTastesRepository $repository,UserRepository $userRepository,MusicalTastesRepository $musicalTastesRepository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->musicalTastesRepository = $musicalTastesRepository;
        $this->em = $em;
    }

    public function execute(MusicalTastesDTO $musicalTastesDTO){

        $user = $this->userRepository->getById($musicalTastesDTO->getId());

        $this->em->clear('filter');

        foreach ($musicalTastesDTO->getMusicalTastes() as $item) {
            $item = $item->getMusicalTaste();
            $musicalTaste = $this->musicalTastesRepository->getById($item->getId());
            $userMusicalTaste = new UserMusicalTaste($musicalTaste,$user);
            $this->repository->saveMusicalTastes($userMusicalTaste);

        }
        $this->em->flush();
        $this->em->clear();

        return TRUE;
    }
}