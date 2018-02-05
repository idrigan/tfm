<?php

use Behat\Behat\Context\Context;
use ProfileBundle\Events\EventDispatcher\Friends\FriendsEvent;
use ProfileBundle\Events\EventSubscriber\FriendsEventSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use ProfileBundle\Events\EventDispatcher\Friends;

class SendInvitationContext implements Context{

    private $email;

    private $kernel;

    private $event;

    public function __construct()
    {}

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
     * @Given recipient valid email :email
     */
    public function recipientValidEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    /**
     * @When send invitation
     */
    public function sendInvitation()
    {
        $email = str_replace("@","#",$this->email);
        //send email
        $event = new FriendsEvent();
        $event->setEmail($email);
        $dispatcher = new EventDispatcher();
        $eventSubscriber = new FriendsEventSubscriber();
        $dispatcher->addSubscriber($eventSubscriber);
        $this->event = $dispatcher->dispatch(FriendsEvent::SENDINVITATION,$event);
    }

    /**
     * @Then invitation sent
     */
    public function invitationSent()
    {
        \PHPUnit_Framework_TestCase::assertInstanceOf( Symfony\Component\EventDispatcher\Event::class,$this->event);
    }

}
