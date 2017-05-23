<?php


namespace Component\Domain\Repository;

use Component\Domain\Entity\User;

interface UserRepository
{
    public function create(User $user);
    public function getUser(String $email);
    public function update($idUser,$nick,$date);
}