<?php

namespace Tests\AppBundle;

use Component\Application\Comment\UseCases\GetCommentByIdUseCase;
use Component\Application\Comment\UseCases\GetCommentUseCase;
use Component\Application\Comment\UseCases\SaveCommentUseCase;
use Component\Domain\DTO\CommentDTO;
use Component\Domain\DTO\CommentsDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use PHPUnit\Framework\TestCase;


class GetCommentByIdUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $getCommentByIdUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $commentRepositoryMock;


    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $commentId;



    protected function setUp()
    {
        $this->commentRepositoryMock = $this->createMock(CommentRepository::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->getCommentByIdUseCase = new GetCommentByIdUseCase($this->commentRepositoryMock, $this->aEntityMock );

        $this->commentId = 1;

    }

    protected function tearDown()
    {
        $this->commentRepositoryMock = null;
        $this->aEntityMock = null;
        $this->getCommentByIdUseCase = null;
    }


    /**
     * @test
     *
     */
    public function testErrorGetCommentByIdUseCase(){
       $commentDTO = new CommentDTO(null);
       $this->assertEquals($this->getCommentByIdUseCase->execute($commentDTO),FALSE);
    }


}

