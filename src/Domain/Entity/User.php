<?php


namespace Domain\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 *  @ORM\Entity(repositoryClass="AppBundle\OAuthBundle\Repository\UserRepository")
 *  @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @ORM\Column(type="string",length=200)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_create;


    /**
     * @ORM\Column(type="integer")
     */
    private $googleId;

    /**
     * User construct
     */
    public function __construct (){

    }
}