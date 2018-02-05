<?php


namespace ProfileBundle\Repository;


use Component\Domain\Entity\UserFriend;
use Component\Domain\Repository\FriendRepository;
use Doctrine\ORM\EntityRepository;


class FriendsRepositoryImpl extends EntityRepository implements FriendRepository
{

    public function getFriendsByUser($idUser)
    {
        $sql =" SELECT u.*,uf.date_create FROM user u LEFT JOIN user_friend uf ON uf.id_user_friend = u.id WHERE  uf.id_user = :idUser AND accepted = 1";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('idUser', $idUser);
        $query->execute();
        $data = $query->fetchAll();


        $sql =" SELECT u.*,uf.date_create FROM user u LEFT JOIN user_friend uf ON uf.id_user = u.id WHERE  uf.id_user_friend = :idUser  AND accepted = 1";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('idUser', $idUser);
        $query->execute();
        return array_merge($query->fetchAll(),$data);
    }


    public function searchFriends($idUser, $value)
    {

        $sql = "SELECT u.*,(SELECT COUNT(*) FROM user_friend uf WHERE (uf.id_user = :idUser AND uf.id_user_friend = u.id OR  uf.id_user_friend=:idUser AND uf.id_user=u.id ) ) AS b_connect FROM user u 
                WHERE email LIKE :value OR nick LIKE :value AND u.id != :idUser  ORDER BY u.email ASC ";

        $statement = $this->getEntityManager()->getConnection()->prepare($sql);

        $statement->bindValue('idUser',$idUser);
        $statement->bindValue('value','%'.$value.'%');

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getUserFriend($idUser,$idFriend){
        return $this->findOneBy(array('idUserFriend'=>$idUser,'idUser'=>$idFriend));
    }

    public function addFriend(UserFriend $userFriend)
    {
        $this->getEntityManager()->persist($userFriend);
    }

    public function getFriendsByUserNoAccept($idUser)
    {
        $sql =" SELECT u.*,uf.date_create FROM user u LEFT JOIN user_friend uf ON uf.id_user = u.id WHERE uf.id_user_friend = :idUser AND accepted = 0 AND cancelled = 0";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('idUser', $idUser);
        $query->execute();
        return $query->fetchAll();
    }

    public function cancelFriend(UserFriend $userFriend)
    {
        $this->getEntityManager()->persist($userFriend);
    }
}
