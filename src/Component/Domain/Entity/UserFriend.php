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

    /**
     * @var \boolean
     */
    private $accepted;

    /**
     * @var \boolean
     */
    private $cancelled;

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->cancelled;
    }

    /**
     * @param bool $cancelled
     */
    public function setCancelled(bool $cancelled)
    {
        $this->cancelled = $cancelled;
    }

    /**
     * @return bool
     */
    public function isViewed(): bool
    {
        return $this->viewed;
    }

    /**
     * @param bool $viewed
     */
    public function setViewed(bool $viewed)
    {
        $this->viewed = $viewed;
    }

    /**
     * @var \boolean
     */
    private $viewed;

    /**
     * UserFriend constructor.
     * @param $idUser
     * @param $idUserFriend
     * @param $date
     * @param bool $accepted
     */

    public function __construct($idUser,$idUserFriend,$date,$accepted = false)
    {
        $this->idUser = $idUser;
        $this->idUserFriend = $idUserFriend;
        $this->dateCreate = $date;
        $this->accepted = $accepted;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     */
    public function setAccepted(bool $accepted)
    {
        $this->accepted = $accepted;
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
