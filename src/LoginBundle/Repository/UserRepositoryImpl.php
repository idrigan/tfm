<?php

namespace LoginBundle\Repository;


use Component\Domain\Entity\User;
use Component\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;

class UserRepositoryImpl extends EntityRepository implements UserRepository
{

    public function create(User $user)
    {
        $this->getEntityManager()->persist($user);
    }

    public function getUser(String $email)
    {
        return $this->findBy(
            array('email' => $email)
        );
    }

    public function update($idUser,$nick,$date)
    {

        $user = $this->getById($idUser);
        $user->setDateCreate($date);
        return $user;
    }

    public function getById($idUser){
        return $this->find($idUser);
    }
}