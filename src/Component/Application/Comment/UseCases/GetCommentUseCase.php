<?php


namespace Component\Application\Comment\UseCases;


use Component\Domain\DTO\CommentDTO;
use Component\Domain\DTO\CommentsDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityManager;

class GetCommentUseCase
{
    private $commentRepository;
    private $em;

    public function __construct(CommentRepository $repository,EntityManager $em)
    {
        $this->commentRepository = $repository;

        $this->em = $em;
    }

    public function execute(UserDTO $userDTO){

        if (empty($userDTO->getId()) || $userDTO->getId() == ''){
            return FALSE;
        }

        $comments =  $this->commentRepository->getAll($userDTO->getId());



        $commentsDTO = new CommentsDTO();
        if ( count($comments ) > 0) {
            foreach ($comments as $index => $comment) {


                $commentDTO = new CommentDTO($comment['id'], $comment['id_user'], $comment['content'], $comment['spotify_id'],
                    $comment['spotify_url'], $comment['type_content'], $comment['email'], $comment['date_create']);

                $commentDTO->setResponses($comment['responses']);

                $commentsDTO->addComment($commentDTO);
            }
        }

        return $commentsDTO;
    }
}