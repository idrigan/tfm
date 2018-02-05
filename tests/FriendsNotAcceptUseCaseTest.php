<?php


namespace Tests;


use Component\Application\User\UseCases\FriendsNotAcceptedUseCase;
use Component\Domain\Entity\User;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class FriendsNotAcceptUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $friendsNotAcceptedUseCase;


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
        $this->friendsNotAcceptedUseCase = new FriendsNotAcceptedUseCase($this->friendRepositoryMock,$this->aEntityMock);

        $this->idUser = 1;
        $this->idUserFriend = 2;
    }

    protected function tearDown()
    {
        $this->friendRepositoryMock = null;
        $this->aEntityMock = null;
        $this->friendsNotAcceptedUseCase = null;
    }

    /**
     * @test
     *
     */
    public function testFriendsNotAcceptdUseCase(){
        $userFriendDTO = new UserFriendDTO($this->idUser,TRUE);

        $userFriendDTO->setIdUser($this->idUserFriend);

        $this->assertSame(UserFriendDTO::class, get_class($this->friendsNotAcceptedUseCase->execute($userFriendDTO)));
    }

    /**
     * @test
     *
     */
    public function testErrorFriendsNotAcceptUseCase(){
        $userFriendDTO = new UserFriendDTO(NULL,TRUE);
        $this->assertEquals($this->friendsNotAcceptedUseCase->execute($userFriendDTO),FALSE);
    }
}
