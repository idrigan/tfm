<?php

namespace Component\Domain\Repository;

interface MusicalTastesRepository
{
    public function getAllMusicalTastes($idUser);
    public function getById($id);
}