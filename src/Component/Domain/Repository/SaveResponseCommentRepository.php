<?php


namespace Component\Domain\Repository;

use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\Publication;
use Component\Domain\Entity\ResponsePublication;

interface SaveResponseCommentRepository
{
    public function save(ResponsePublication $response);

}