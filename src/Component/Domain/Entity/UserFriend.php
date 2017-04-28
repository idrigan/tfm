<?php

namespace Component\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserFriendRepositoryImpl")
 *  @ORM\Table(name="user_friend")
 */
class UserFriend
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * One user have many friends.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;

    /**
     * One user have many friends.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user_friend", referencedColumnName="id")
     */
    private $idUserFriend;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_create;

    public function __construct($idUser,$idUserFriend,$date_create)
    {
        $this->idUser = $idUser;
        $this->idUserFriend = $idUserFriend;
        $this->date_create = $date_create;
    }


}