<?php


namespace ProfileBundle\Events\EventDispatcher\Contact;


use Symfony\Component\EventDispatcher\Event;

class ContactEvent extends Event
{
    private $email;
    private $message;
    private $name;

    CONST SENDCONTACT = "contact.send.message";

    public function setData(String $name, String $email, String $message){
        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
    }

    public function getEmail():String{
        return $this->email;
    }

    public function getName():String{
        return $this->name;
    }

    public function getMessage():String{
        return $this->message;
    }
}
