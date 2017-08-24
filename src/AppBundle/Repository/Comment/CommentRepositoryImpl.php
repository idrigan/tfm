<?php


namespace AppBundle\Repository\Comment;

use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\Publication;
use Component\Domain\Entity\ResponsePublication;
use Component\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityRepository;

class CommentRepositoryImpl extends EntityRepository implements CommentRepository
{

    public function save(Publication $publication)
    {

        $this->getEntityManager()->persist($publication);
    }

    public function getAll($idUser)
    {

        $friends = $this->getFriends($idUser);
        $users = array();
        foreach ($friends as $f) {
            $users[] = $f['id_user'];
        }
        $users[] = $idUser;

        $result = $this->getComments($users);
        return $result;

    }

    private function getFriends($idUser){
        $sql =" SELECT uf.id_user_friend FROM  user_friend uf  WHERE  uf.id_user = :idUser AND accepted = 1";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('idUser', $idUser);
        $query->execute();
        $data = $query->fetchAll();


        $sql =" SELECT uf.id_user FROM user_friend uf WHERE  uf.id_user_friend = :idUser  AND accepted = 1";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('idUser', $idUser);
        $query->execute();
        return array_merge($query->fetchAll(),$data);
    }


    private function  getComments($users){
        $users = join(",",$users);
        $sql = " SELECT p.*,u.email FROM publication p
                LEFT JOIN user u ON p.id_user = u.id
                WHERE p.active =1 AND p.id_user IN ($users) ORDER BY p.date_create DESC";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
    //    $query->bindValue('idUser', $idUser);
        $query->execute();
        $result = $query->fetchAll();


        foreach ($result as $index => $row) {

            $sql = "SELECT rp.*,u.email FROM response_publication rp
                     LEFT JOIN user u ON  u.id = rp.id_user
                     WHERE id_publication = :idPublication ORDER BY date_create";

            $query = $this->getEntityManager()->getConnection()->prepare($sql);
            $query->bindValue('idPublication', $row['id']);
            $query->execute();
            $responses = $query->fetchAll(\PDO::FETCH_CLASS, ResponsePublication::class);


            $result[$index]['responses'] = $responses;

        }

        return $result;
    }

    public function getById($idComment)
    {
        return $this->find($idComment);
    }
}