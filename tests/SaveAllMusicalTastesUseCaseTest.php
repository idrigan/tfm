<?php


namespace Tests;


use Component\Application\User\UseCases\GetAllMusicalTastesUseCase;
use Component\Application\User\UseCases\SaveMusicalTastesUseCase;
use Component\Domain\DTO\MusicalTastesDTO;
use Component\Domain\Entity\User;
use Component\Domain\Repository\MusicalTastesRepository;
use Component\Domain\Repository\UserMusicalTastesRepository;
use Component\Domain\Repository\UserRepository;
use LoginBundle\Repository\UserRepositoryImpl;
use Component\Application\User\UseCases\AddFriendUseCase;
use Component\Domain\DTO\UserFriendDTO;
use Doctrine\ORM\EntityManager;
use ProfileBundle\Repository\FriendsRepositoryImpl;


class SaveAllMusicalTastesUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserMusicalTastesRepository
     */
    private $userMusicalTasteRepository;

    /**
     * @var userRepository
     */
    private $userRepository;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $musicalTastesRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    /**
     * @var saveMusicalTasteUseCase
     */
    private $saveAllMusicalTaste;

    private $idUser;

    protected function setUp()
    {
        $this->musicalTastesRepositoryMock = $this->createMock(MusicalTastesRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->userMusicalTasteRepository = $this->createMock(UserMusicalTastesRepository::class);
        $this->saveAllMusicalTaste = new SaveMusicalTastesUseCase($this->userMusicalTasteRepository,$this->userRepository,$this->musicalTastesRepositoryMock,$this->aEntityMock);

        $this->idUser = 1;
    }

    protected function tearDown()
    {
        $this->aEntityMock = null;
        $this->userRepository = null;
        $this->userMusicalTasteRepository = null;
        $this->musicalTastesRepositoryMock = null;
        $this->saveAllMusicalTaste = null;
    }

    /**
     * @test
     *
     */
    public function testSaveMusicalTastes(){

        $musicalTasteDTO = new MusicalTastesDTO();
        $musicalTasteDTO->setId($this->idUser);
        $this->assertEquals($this->saveAllMusicalTaste->execute($musicalTasteDTO),TRUE);
    }

    /**
     * @test
     *
     */
    public function testErrorSaveMusicalTastes(){
        $musicalTasteDTO = new MusicalTastesDTO();
        $musicalTasteDTO->setId(null);
        $this->assertEquals($this->saveAllMusicalTaste->execute($musicalTasteDTO),FALSE);
    }
}
