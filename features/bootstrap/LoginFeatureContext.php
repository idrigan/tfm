<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\HttpKernel\KernelInterface;

class LoginFeatureContext extends MinkContext implements Context, KernelAwareContext
{

    private $email;

    private $userDTO;

    private $kernel;

    public function __construct(){}

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {

        $this->kernel = $kernel;
    }


    /**
     * @Given valid email :email
     */
    public function validEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    /**
     * @When executing the Google Auth give name :arg1 familyName :arg2 picture :arg3
     */
    public function executingTheGoogleAuthGiveNameFamilynamePicture($name, $familyName, $picture)
    {
        $this->userDTO = new \Component\Domain\DTO\UserDTO($this->email,$name." ".$familyName, $picture);
    }

    /**
     * @Then user register in system
     */
    public function userRegisterInSystem()
    {
        //$loginUseCase = $this->kernel->getContainer()->get('app.user.usecase.loginusecase');

        //$loginUseCase->execute($this->userDTO);
    }

}