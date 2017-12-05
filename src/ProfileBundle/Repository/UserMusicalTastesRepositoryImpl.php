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

    public function searchFriendsByMusicalTaste($idUser, $value)
    {

        $sql = "SELECT u.*,(SELECT COUNT(*) FROM user_friend uf WHERE (uf.id_user = :idUser AND uf.id_user_friend = u.id OR  uf.id_user_friend=:idUser AND uf.id_user=u.id ) ) AS b_connect
                  FROM musical_taste mt LEFT JOIN user_musical_taste umt ON mt.id = umt.id_musical_taste LEFT JOIN user u ON u.id = umt.id_user WHERE mt.name LIKE :value AND u.id != :idUser
                   ORDER BY u.email ASC";

        $statement = $this->getEntityManager()->getConnection()->prepare($sql);

        $statement->bindValue('value','%'.$value.'%');
        $statement->bindValue('idUser',$idUser);

        $statement->execute();

        return $statement->fetchAll();
    }
}