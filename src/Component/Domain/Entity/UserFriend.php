<?php

namespace Component\Domain\Entity;

/**
 * UserFriend
 */
class UserFriend
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateCreate;

    /**
     * @var \Component\Domain\Entity\User
     */
    private $idUser;

    /**
     * @var \Component\Domain\Entity\User
     */
    private $idUserFriend;


    public function __construct($idUser,$idUserFriend,$date)
    {
        $this->idUser = $idUser;
        $this->idUserFriend = $idUserFriend;
        $this->dateCreate = $date;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return UserFriend
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set idUser
     *
     * @param \Component\Domain\Entity\User $idUser
     *
     * @return UserFriend
     */
    public function setIdUser(\Component\Domain\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Component\Domain\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idUserFriend
     *
     * @param \Component\Domain\Entity\User $idUserFriend
     *
     * @return UserFriend
     */
    public function setIdUserFriend(\Component\Domain\Entity\User $idUserFriend = null)
    {
        $this->idUserFriend = $idUserFriend;

        return $this;
    }

    /**
     * Get idUserFriend
     *
     * @return \Component\Domain\Entity\User
     */
    public function getIdUserFriend()
    {
        return $this->idUserFriend;
    }
}
