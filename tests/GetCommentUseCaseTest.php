<?php

namespace Tests\AppBundle;

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


class GetCommentUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $getCommentUserCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $commentRepositoryMock;


    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $comment1;
    private $comment2;
    private $user;



    protected function setUp()
    {
        $this->commentRepositoryMock = $this->createMock(CommentRepository::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->getCommentUserCase = new GetCommentUseCase($this->commentRepositoryMock, $this->aEntityMock );

        $this->user = 1;

    }

    protected function tearDown()
    {
        $this->commentRepositoryMock = null;
        $this->aEntityMock = null;
        $this->getCommentUserCase = null;
    }


    /**
     * @test
     *
     */
    public function testErrorGetCommentUseCase(){

       $userDTO = new UserDTO();
       $userDTO->setId(null);

        $this->assertEquals($this->getCommentUserCase->execute($userDTO),FALSE);
    }

    /**
     * @test
     *
     */
    public function testGetCommentUseCase(){
        $userDTO = new UserDTO();
        $userDTO->setId($this->user);

        $this->assertSame(CommentsDTO::class,get_class($this->getCommentUserCase->execute($userDTO)));
    }
}

