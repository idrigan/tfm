<?php


namespace Tests;


use Component\Application\User\UseCases\CancelFriendUseCase;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserRepository;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class CancelFriendUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $cancelFriendUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $useRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $friendRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $email;
    private $idUser;
    private $idUserFriend;

    protected function setUp()
    {
        $this->useRepositoryMock = $this->createMock(UserRepository::class);
        $this->friendRepositoryMock = $this->createMock(FriendsRepositoryImpl::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->cancelFriendUseCase = new CancelFriendUseCase($this->friendRepositoryMock,$this->useRepositoryMock,$this->aEntityMock);

        $this->email = 'prueba@gmail.com';
        $this->idUser = 1;
        $this->idUserFriend = 2;
    }

    protected function tearDown()
    {
        $this->userRepositoryMock = null;
        $this->commentUserCase = null;
        $this->friendRepositoryMock = null;
        $this->aEntityMock = null;
        $this->cancelFriendUseCase = null;
    }

    /**
     * @test
     *
     */
    public function testCancelFriendUseCase(){
        $userFriendDTO = new UserFriendDTO($this->idUser,TRUE);

        $userFriendDTO->setIdUser($this->idUserFriend);

        $this->assertEquals($this->cancelFriendUseCase->execute($userFriendDTO),TRUE);
    }

    /**
     * @test
     *
     */
    public function testErrorCancelFriendUseCaseEmptyFriend(){
        $userFriendDTO = new UserFriendDTO($this->idUser,TRUE);
        $userFriendDTO->addFriend(new User('','',null));
        $this->assertEquals($this->cancelFriendUseCase->execute($userFriendDTO),FALSE);
    }

    /**
     * @test
     *
     */
    public function testErrorCancelFriendUseCaseEmptyUser(){
        $userFriendDTO = new UserFriendDTO(null,TRUE);
        $userFriendDTO->addFriend(new User('prueba@gmail.cd','',null));
        $this->assertEquals($this->cancelFriendUseCase->execute($userFriendDTO),FALSE);
    }
}
