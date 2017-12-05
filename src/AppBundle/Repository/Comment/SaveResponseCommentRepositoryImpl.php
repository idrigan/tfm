<?php

namespace AppBundle\Repository\Comment;


use Component\Domain\Entity\ResponsePublication;
use Component\Domain\Repository\SaveResponseCommentRepository;
use Doctrine\ORM\EntityRepository;

class SaveResponseCommentRepositoryImpl extends EntityRepository implements SaveResponseCommentRepository
{

    public function save(ResponsePublication $response)
    {
        $this->getEntityManager()->persist($response);
    }
}