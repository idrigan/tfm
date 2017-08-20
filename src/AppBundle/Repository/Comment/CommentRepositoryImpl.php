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


        $sql =" SELECT p.*,u.email 
              FROM publication p LEFT JOIN user_friend uf ON p.id_user = uf.id_user_friend AND  uf.id_user =:idUser
              LEFT JOIN user u ON u.id = uf.id_user_friend OR u.id = p.id_user
              WHERE p.id_user =:idUser AND p.active =1 ORDER BY p.date_create ASC";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('idUser', $idUser);
        $query->execute();
        $result =  $query->fetchAll();



        foreach ($result as $index=>$row){

            $sql = "SELECT rp.*,u.email FROM response_publication rp
                     LEFT JOIN user u ON  u.id = rp.id_user
                     WHERE id_publication = :idPublication ORDER BY date_create";

            $query = $this->getEntityManager()->getConnection()->prepare($sql);
            $query->bindValue('idPublication', $row['id']);
            $query->execute();
            $responses =  $query->fetchAll(\PDO::FETCH_CLASS,ResponsePublication::class);


            $result[$index]['responses'] = $responses;

        }


        return $result;
    }

    public function getById($idComment)
    {
        return $this->find($idComment);
    }
}