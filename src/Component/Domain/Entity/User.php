<?php


namespace Component\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 *
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserRepositoryImpl")
 *  @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string",length=200)
     */
    private $nick;

    /**
     * @ORM\Column(type="string",length=200)
     */
    private $email;


    /**
     * @ORM\Column(type="datetime")
     */
    private $last_connect;


    /**
     * User construct
     */
    public function __construct ($email,$last_connect){
        $this->email = $email;
        $this->last_connect = $last_connect;
    }

    public function getId(){
        return $this->id;
    }

    public function setNick($nick){
        $this->nick = $nick;
    }

    public function setLastConnect($last_connect){
        $this->last_connect = $last_connect;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }
}