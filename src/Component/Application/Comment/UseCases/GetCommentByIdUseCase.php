<?php


namespace Component\Application\Comment\UseCases;


use Component\Domain\DTO\CommentDTO;
use Component\Domain\DTO\CommentsDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityManager;

class GetCommentByIdUseCase
{
    private $commentRepository;

    public function __construct(CommentRepository $repository,EntityManager $em)
    {
        $this->commentRepository = $repository;

    }

    public function execute(CommentDTO $commentDTO){

        if (empty($commentDTO->getId()) || $commentDTO->getId() == ''){
            return FALSE;
        }

        return $this->commentRepository->getById($commentDTO->getId());

    }
}