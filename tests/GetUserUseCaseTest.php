<?php


namespace Tests;


use Component\Application\User\UseCases\GetUserUseCase;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserRepository;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class GetUserUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $getUserUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;


    private $email;
    private $idUser;


    protected function setUp()
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->getUserUseCase = new GetUserUseCase($this->userRepositoryMock);

        $this->email = 'idrigan@gmail.com';
        $this->idUser = 1;

    }

    protected function tearDown()
    {
        $this->userRepositoryMock = null;
        $this->getUserUseCase = null;
    }

    /**
     * @test
     *
     */
    public function testGetUserByEmailUseCase(){
        $userDTO  = new UserDTO();
        $userDTO->setEmail($this->email);
        //$this->assertSame(User::class,$this->getUserUseCase->execute($userDTO));
    }

    /**
     * @test
     *
     */
    public function testErrorGetUserByEmailUseCase(){
        $userDTO  = new UserDTO();
        $userDTO->setEmail("");
        $this->assertEquals($this->getUserUseCase->execute($userDTO),FALSE);
    }

    /**
     * @test
     *
     */
    public function testErrorNotValidEmailGetUserByEmailUseCase(){
        $userDTO  = new UserDTO();
        $userDTO->setEmail("sss.com");
        $this->assertEquals($this->getUserUseCase->execute($userDTO),FALSE);
    }
    /**
     * @test
     *
     */
    public function testGetUserByIdUseCase(){
        $userDTO = new UserDTO();
        $userDTO->setId($this->idUser);
    //    $this->assertSame(User::class,$this->getUserUseCase->execute($userDTO));
    }

    /**
     * @test
     *
     */
    public function testErrorGetUserByIdUseCase(){
        $userDTO = new UserDTO();
        $userDTO->setId("");
        $this->assertEquals($this->getUserUseCase->execute($userDTO),FALSE);
    }
}
