<?php


namespace Tests;


use Component\Application\User\UseCases\SearchFriendsByMusicalTastesUseCase;
use Component\Domain\Entity\User;
use Component\Domain\Repository\UserMusicalTastesRepository;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class SearchFriendByMusicalTastesUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $searchFriendsByMusicalTastesUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userMusicalTastesRepositoryMock;

    private $idUser;
    private $search;

    protected function setUp()
    {
        $this->userMusicalTastesRepositoryMock = $this->createMock(UserMusicalTastesRepository::class);
        $this->searchFriendsByMusicalTastesUseCase = new SearchFriendsByMusicalTastesUseCase($this->userMusicalTastesRepositoryMock);

        $this->search = 'a.arteche.g@gmail.com';
        $this->idUser = 1;
    }

    protected function tearDown()
    {
        $this->userMusicalTastesRepositoryMock = null;
        $this->searchFriendsByMusicalTastesUseCase = null;
        $this->search = '';
        $this->idUser = '';

    }

    /**
     * @test
     *
     */
    public function testSearchFriendUseCase(){
        $this->assertEquals($this->searchFriendsByMusicalTastesUseCase->execute("",$this->search),FALSE);
    }



    /**
     * @test
     *
     */
    public function testEmptySearchFriendUseCase(){
        $this->assertEmpty($this->searchFriendsByMusicalTastesUseCase->execute($this->idUser,"carteche@gmail.com"));
    }
}
