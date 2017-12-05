<?php


namespace Component\Domain\Repository;

use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\Publication;

interface CommentRepository
{
    public function save(Publication $publication);
    public function getAll($idUser);
    public function getById($idComment);
}