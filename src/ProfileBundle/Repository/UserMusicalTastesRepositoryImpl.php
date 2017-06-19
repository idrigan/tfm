<?php

namespace ProfileBundle\Repository;


use Component\Domain\Entity\UserMusicalTaste;
use Component\Domain\Repository\UserMusicalTastesRepository;
use Doctrine\ORM\EntityRepository;

class UserMusicalTastesRepositoryImpl  extends EntityRepository implements UserMusicalTastesRepository
{

    public function saveMusicalTastes(UserMusicalTaste $userMusicalTaste)
    {

        $user = $userMusicalTaste->getIdUser();

        $query = $this->getEntityManager()->getConnection()->prepare("DELETE FROM user_musical_taste WHERE id_user =:idUser;");

        $query->bindValue("idUser",$user->getId());

        $query->execute();

        $this->getEntityManager()->persist($userMusicalTaste);
    }

    public function getAllMusicalTastesByUser($idUser){

        return $this->findBy(array('idUser'=>$idUser));
    }
}