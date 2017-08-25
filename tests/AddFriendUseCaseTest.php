<?php


namespace Tests\LoginBundle;


use Component\Domain\Entity\User;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class AddFriendUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $addFriendUseCase;

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
        $this->useRepositoryMock = $this->createMock(UserRepositoryImpl::class);
        $this->friendRepositoryMock = $this->createMock(FriendsRepositoryImpl::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->addFriendUseCase = new AddFriendUseCase($this->friendRepositoryMock,$this->useRepositoryMock,$this->aEntityMock);

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
        $this->addFriendUseCase = null;
    }

    /**
     * @test
     *
     */
    public function testAddFriendUseCase(){
        $userFriendDTO = new UserFriendDTO($this->idUser,TRUE);


        $userFriendDTO->setIdUser($this->idUserFriend);

        $this->assertEquals($this->addFriendUseCase->execute($userFriendDTO),TRUE);
    }

    /**
     * @test
     *
     */
    public function testErrorAddFriendUseCase(){
        $userFriendDTO = new UserFriendDTO($this->idUser,TRUE);
        $userFriendDTO->addFriend(new User('prueba@gmail.cd',''));
        $this->assertEquals($this->addFriendUseCase->execute($userFriendDTO),FALSE);
    }
}
