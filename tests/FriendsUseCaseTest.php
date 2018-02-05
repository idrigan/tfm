<?php


namespace Tests;


use Component\Application\User\UseCases\FriendsNotAcceptedUseCase;
use Component\Application\User\UseCases\FriendsUseCase;
use Component\Domain\Entity\User;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class FriendsUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $friendsUseCase;


    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $friendRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $idUser;

    private $idUserFriend;

    protected function setUp()
    {
        $this->friendRepositoryMock = $this->createMock(FriendsRepositoryImpl::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->friendsUseCase = new FriendsUseCase($this->friendRepositoryMock,$this->aEntityMock);

        $this->idUser = 1;
        $this->idUserFriend = 2;
    }

    protected function tearDown()
    {
        $this->friendRepositoryMock = null;
        $this->aEntityMock = null;
        $this->friendsUseCase = null;
    }

    /**
     * @test
     *
     */
    public function testFriendsNotAcceptdUseCase(){
        $userFriendDTO = new UserFriendDTO($this->idUser,TRUE);

        $userFriendDTO->setIdUser($this->idUserFriend);

        $this->assertSame(UserFriendDTO::class, get_class($this->friendsUseCase->execute($userFriendDTO)));
    }

    /**
     * @test
     *
     */
    public function testErrorFriendsNotAcceptUseCase(){
        $userFriendDTO = new UserFriendDTO(NULL,TRUE);
        $this->assertEquals($this->friendsUseCase->execute($userFriendDTO),FALSE);
    }
}
