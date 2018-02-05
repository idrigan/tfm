<?php


namespace Component\Application\Comment\UseCases;


use Component\Domain\DTO\CommentDTO;
use Component\Domain\Entity\Publication;
use Component\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityManager;

class SaveCommentUseCase
{

    private $commentRepository;
    private $em;

    public function __construct(CommentRepository $repository,EntityManager $em)
    {
        $this->commentRepository = $repository;

        $this->em = $em;
    }

    public function execute(CommentDTO $commentDTO){

        if (empty($commentDTO->getComment()) && empty($commentDTO->getTrackId())){
            return FALSE;
        }

        $publication = new Publication();
        $publication->setActive(true);
        $publication->setContent($commentDTO->getComment());
        $publication->setIdUser($commentDTO->getIdUser());
        $date = new \DateTime();
        $date->format("Y-m-d H:i:s");
        $publication->setTitle("");
        $publication->setTypeContent($commentDTO->getType());
        $publication->setDateCreate($date);
        $publication->setSpotifyUrl($commentDTO->getUrl());
        $publication->setSpotifyId($commentDTO->getTrackId());
        $this->commentRepository->save($publication);
        $this->em->flush();
    }
}