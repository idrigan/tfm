<?php


namespace Component\Domain\Repository;


use Component\Domain\Entity\User;

interface UserRepository
{
    public function createUser(User $user);
    public function getUser(String $email);
}