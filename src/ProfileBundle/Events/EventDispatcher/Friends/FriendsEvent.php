<?php


namespace ProfileBundle\Events\EventDispatcher\Friends;


use Symfony\Component\EventDispatcher\Event;

class FriendsEvent extends Event
{
    private $email;

    CONST SENDINVITATION = "friends.send.invitation";

    public function setEmail(String $email){
        $this->email = $email;
    }

    public function getEmail():String{
        return $this->email;
    }
}