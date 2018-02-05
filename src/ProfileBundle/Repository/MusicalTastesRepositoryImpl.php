<?php

namespace ProfileBundle\Repository;



use Component\Domain\Repository\MusicalTastesRepository;
use Doctrine\ORM\EntityRepository;

class MusicalTastesRepositoryImpl extends EntityRepository implements MusicalTastesRepository
{

    public function getAllMusicalTastes($idUser)
    {
      $sql = "SELECT mt.*, (SELECT COUNT(*) FROM user_musical_taste umt WHERE id_user = :idUser AND id_musical_taste = mt.id) AS b_checked FROM musical_taste mt  ";
      $query = $this->getEntityManager()->getConnection()->prepare($sql);
      $query->bindValue('idUser', $idUser);
      $query->execute();
       return $query->fetchAll();
    }


    public function getById($id)
    {
        return $this->find($id);
    }
}