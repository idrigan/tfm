<?php


namespace Tests;


use Component\Application\User\UseCases\SearchFriendsByMusicalTastesUseCase;
use Component\Application\User\UseCases\SearchFriendsUseCase;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserMusicalTastesRepository;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class SearchFriendUseCaseTest extends \PHPUnit_Framework_TestCase
{

    /*
     * FriendRepository $repository,UserMusicalTastesRepository $userMusicalTastes,EntityManager $em
     * */

    /**
     * @var SearchFriendsUseCase
     */
    private $searchFriendsUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userMusicalTastesRepositoryyMock;

    /**
     * @var friendRepository
     */
    private $friendRepository;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $idUser = 1;
    private $search  = 'a.arteche.g@gmail.com';

    protected function setUp()
    {
        $this->userMusicalTastesRepositoryyMock = $this->createMock(UserMusicalTastesRepository::class);
        $this->friendRepository= $this->createMock(FriendsRepositoryImpl::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->searchFriendsUseCase = new SearchFriendsUseCase($this->friendRepository,$this->userMusicalTastesRepositoryyMock,$this->aEntityMock);
        $this->search = 'a.arteche.g@gmail.com';
        $this->idUser = 1;
    }

    protected function tearDown()
    {
        $this->userMusicalTastesRepositoryyMock = null;
        $this->friendRepository = null;
        $this->aEntityMock = null;
        $this->search = '';
        $this->idUser = '';

    }

    /**
     * @test
     *
     */
    public function testErrorSearchFriendUseCase(){
        $this->assertEquals($this->searchFriendsUseCase->execute(NULL,$this->search),FALSE);
    }



    /**
     * @test
     *
     */
    public function testEmptySearchFriendUseCase(){
        $this->assertEmpty($this->searchFriendsUseCase->execute($this->idUser,$this->search));
    }
}
