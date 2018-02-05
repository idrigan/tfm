<?php
/**
 * Created by PhpStorm.
 * User: charlie
 * Date: 25/1/18
 * Time: 22:23
 */

namespace Tests;

use Component\Application\Comment\UseCases\GetCommentByIdUseCase;
use Component\Application\Comment\UseCases\SaveResponseCommentUseCase;
use Component\Application\User\UseCases\GetUserUseCase;
use Component\Domain\Entity\User;
use Doctrine\ORM\EntityManager;
use Component\Domain\DTO\ResponseCommentDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\Publication;
use Component\Domain\Repository\CommentRepository;
use Component\Domain\Repository\SaveResponseCommentRepository;
use Component\Domain\Repository\UserRepository;


class AddResponseCommentUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $saveResponseCommentUserCase;

    /**
     * @var GetUserUseCase
     */
    private $userCase;

    /**
     * @var GetCommentByIdUseCase
     */
    private $publicationUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $saveCommentRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $commentRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;



    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $idComment;
    private $response;
    private $emptyResponse;
    private $idUser;



    protected function setUp()
    {
        $this->saveCommentRepositoryMock = $this->createMock(SaveResponseCommentRepository::class);
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->commentRepositoryMock = $this->createMock(CommentRepository::class);

        $this->aEntityMock = $this->createMock(EntityManager::class);

        $this->saveResponseCommentUserCase = new SaveResponseCommentUseCase($this->saveCommentRepositoryMock, $this->aEntityMock );
        $this->userCase = new GetUserUseCase($this->userRepositoryMock);
        $this->publicationUseCase = new GetCommentByIdUseCase($this->commentRepositoryMock,$this->aEntityMock);

        $this->idUser = 1;
        $this->idComment = 1;
        $this->response = 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.';
        $this->emptyResponse = '';
    }

    protected function tearDown()
    {
        $this->saveCommentRepositoryMock = null;
        $this->aEntityMock = null;
        $this->saveResponseCommentUserCase = null;
    }


    /**
     * @test
     *
     */
    public function testErrorSaveResponse(){

       $user = new User('','','');

       $this->assertEquals( $this->saveResponseCommentUserCase->execute(new ResponseCommentDTO(new Publication(),$this->emptyResponse,$user)),FALSE);
    }

    /**
     * @test
     *
     */
    public function testSaveResponse(){

        $user = new UserDTO();
        $user->setId($this->idUser);
        $userData = $this->userCase->execute($user);
        //$publication = $this->publicationUseCase->execute(new CommentDTO($this->idComment));



        $this->assertEquals( $this->saveResponseCommentUserCase->execute(new ResponseCommentDTO(new Publication(),$this->response,new User("","",""))),TRUE);
    }
}
