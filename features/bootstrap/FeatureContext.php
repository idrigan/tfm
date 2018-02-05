<?php

use Behat\Behat\Context\Context;
use Component\Domain\Entity\MusicalTaste;
use Component\Domain\Entity\User;
use Component\Domain\Entity\UserMusicalTaste;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $kernel;
    private $user;
    private $tasteMusical;
    private $userMusicalTaste;

    public function __construct()
    {
    }
    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }
    /**
     * @Given a user from session :user
     *
     */
    public function aUserFromSession($user){
        $this->user = new User($user,"",null);

    }
    /**
     * @Given a taste musical :musicalTaste
     */
    public function aTasteMusical($musicalTaste){
        $this->tasteMusical = new MusicalTaste();
        $this->tasteMusical->setName($musicalTaste);
    }
    /**
     * @When /executing the saveMusicalTastesUseCase$/
     */
    public function executingTheSaveMusicalTastesUseCase()
    {
        $this->userMusicalTaste = new UserMusicalTaste($this->tasteMusical,$this->user);


    }
    /**
     * @Then /A musical tastes is saved$/
     */
    public function aMusicalTastesIsSaved()
    {
        \PHPUnit_Framework_TestCase::assertInstanceOf(UserMusicalTaste::class,$this->userMusicalTaste);
    }




}
