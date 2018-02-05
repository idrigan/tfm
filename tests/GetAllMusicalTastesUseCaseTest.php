<?php


namespace Tests;


use Component\Application\User\UseCases\GetAllMusicalTastesUseCase;
use Component\Domain\DTO\MusicalTastesDTO;
use Component\Domain\Entity\User;
use Component\Domain\Repository\MusicalTastesRepository;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class GetAllMusicalTastesUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GetAllMusicalTastes
     */
    private $getAllMusicalTaste;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $musicalTastesRepositoryMock;


    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $idUser;

    protected function setUp()
    {
        $this->musicalTastesRepositoryMock = $this->createMock(MusicalTastesRepository::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->getAllMusicalTaste = new GetAllMusicalTastesUseCase($this->musicalTastesRepositoryMock,$this->aEntityMock);

        $this->idUser = 1;
    }

    protected function tearDown()
    {
        $this->aEntityMock = null;
        $this->musicalTastesRepositoryMock = null;
        $this->getAllMusicalTaste = null;
    }

    /**
     * @test
     *
     */
    public function testGetAllMusicalTastes(){
        $this->assertSame(MusicalTastesDTO::class,get_class($this->getAllMusicalTaste->execute($this->idUser)));
    }

    /**
     * @test
     *
     */
    public function testErrorGetAllMusicalTastes(){
        $this->assertEquals($this->getAllMusicalTaste->execute(null),FALSE);
    }
}
