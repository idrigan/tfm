<?php


namespace Component\Application\Comment\UseCases;


use Component\Domain\DTO\ResponseCommentDTO;
use Component\Domain\Entity\ResponsePublication;
use Component\Domain\Repository\SaveResponseCommentRepository;
use Doctrine\ORM\EntityManager;

class SaveResponseCommentUseCase
{
    private $responseCommentRepository;
    private $em;

    public function __construct(SaveResponseCommentRepository $repository,EntityManager $em)
    {
        $this->responseCommentRepository = $repository;

        $this->em = $em;
    }

    public function execute(ResponseCommentDTO $response){

        try {

            $responsePublication = new ResponsePublication();
            $responsePublication->setContent($response->getResponse());

            $responsePublication->setIdUser($response->getUser());
            $responsePublication->setIdPublication($response->getPublication());
            $responsePublication->setActive(true);
            $date = new \DateTime();
            $date->format("Y-m-d H:i:s");
            $responsePublication->setDateCreate($date);
            $responsePublication->setTypeContent("TEXT");

            $this->responseCommentRepository->save($responsePublication);
            $this->em->flush();
            return TRUE;
        }catch(\Exception $e){
            echo $e->getMessage();exit();
            return FALSE;
        }
    }
}