<?php

namespace Tests\AppBundle;

use Component\Application\Comment\UseCases\SaveCommentUseCase;
use Component\Domain\DTO\CommentDTO;
use Component\Domain\Repository\CommentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use PHPUnit\Framework\TestCase;


class SaveCommentUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $commentUserCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $commentRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aDispatcherMock;

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
        $this->aDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->commentUserCase = new SaveCommentUseCase($this->commentRepositoryMock, $this->aEntityMock );

        $this->user = 1;
        $this->comment1 = '';
        $this->comment2 = 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.';
    }

    protected function tearDown()
    {
        $this->commentRepositoryMock = null;
        $this->aDispatcherMock = null;
        $this->aEntityMock = null;
        $this->commentUserCase = null;
    }


    /**
     * @test
     *
     */
    public function testErrorSaveCommentEmptyComment(){

        $commentDTO = new CommentDTO('',$this->user,$this->comment1,'','','');

        $this->assertEquals($this->commentUserCase->execute($commentDTO),FALSE);
    }

    /**
     * @test
     *
     */
    public function testSaveCommentEmptyComment(){

        $commentDTO = new CommentDTO('',$this->user,$this->comment2,'','','');

        $this->assertEquals($this->commentUserCase->execute($commentDTO),NULL);
    }
}

