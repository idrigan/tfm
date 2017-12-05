<?php
namespace ProfileBundle\Features\Context;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Component\Domain\Entity\MusicalTaste;
use Component\Domain\Entity\User;
use Component\Domain\Entity\UserMusicalTaste;
use Symfony\Component\HttpKernel\KernelInterface;




/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements KernelAwareContext
{
    private $kernel;

    private $user;
    private $tasteMusical;
    private $userMusicalTaste;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
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
     * @Given /the user "([^"]*)" for taste musical$/
     */
    public function theUserForTasteMusical($user){
        $this->user = new User($user,'');
    }

    /**
     * @Given /with a taste musical "([^"]*)"$/
     */
    public function whitATasteMusical($tasteMusical){
        $this->tasteMusical = new MusicalTaste('',$tasteMusical,'');
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
