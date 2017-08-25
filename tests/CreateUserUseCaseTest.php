<?php


namespace Tests\LoginBundle;


use Component\Application\User\UseCases\CreateUserUseCase;
use Component\Application\User\UseCases\LoginUseCase;
use Component\Domain\DTO\ResponseDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\User;
use Doctrine\ORM\EntityManager;
use LoginBundle\Repository\UserRepositoryImpl;


class CreateUserUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SaveCommentUseCase
     */
    private $loginUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $useRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    private $email;
    private $email2;
    private $email3;


    protected function setUp()
    {
        $this->useRepositoryMock = $this->createMock(UserRepositoryImpl::class);
        $this->aEntityMock = $this->createMock(EntityManager::class);
        $this->loginUseCase = new LoginUseCase($this->useRepositoryMock,$this->aEntityMock);

        $this->email = 'carteche@zitelia.com';
        $this->email2= 'car.com';
        $this->email3= 'idrigan@gmail.com';
    }

    protected function tearDown()
    {
        $this->userRepositoryMock = null;
        $this->commentUserCase = null;
        $this->aEntityMock = null;
        $this->loginUseCase = null;
    }

    /**
     * @test
     *
     */
    public function testCreateUser(){

        $userDTO = new UserDTO($this->email);

        $data = array(
            'id'=>'',
            'nick'=>'',
            'email'=>$this->email,
            'locale'=>'',
            'picture'=>'',
            'name'=>''
        );
        $this->assertEquals($this->loginUseCase->execute($userDTO),new ResponseDTO($data,"/home"));
    }

    public function testUpdateUser(){
        $userDTO = new UserDTO($this->email3);

        $data = array(
            'id'=>'',
            'nick'=>'',
            'email'=>$this->email3,
            'locale'=>'',
            'picture'=>'',
            'name'=>''
        );
        $this->assertEquals($this->loginUseCase->execute($userDTO),new ResponseDTO($data,"/home"));
    }

    /**
     * @test
     * Email no correcto
     */
    public function testErrorCreateUser(){
        $userDTO = new UserDTO($this->email2);
       $this->assertEquals($this->loginUseCase->execute($userDTO),FALSE);
    }

}
