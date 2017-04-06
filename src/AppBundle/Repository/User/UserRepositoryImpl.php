<?php

namespace AppBundle\Repository\User;


use Component\Domain\Entity\User;

use Component\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;

class UserRepositoryImpl extends EntityRepository implements UserRepository
{

    public function createUser(User $user)
    {
        $this->getEntityManager()->persist($user);

    }


    public function getUser(String $email)
    {
        return $this->findBy(
            array('email' => $email)
        );
    }
}