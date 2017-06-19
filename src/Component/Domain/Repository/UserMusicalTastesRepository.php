<?php


namespace Component\Domain\Repository;


use Component\Domain\Entity\UserMusicalTaste;

interface UserMusicalTastesRepository
{
    public function saveMusicalTastes(UserMusicalTaste $userMusicalTaste);
    public function getAllMusicalTastesByUser($idUser);
}