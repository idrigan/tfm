<?php

namespace Component\Domain\Entity;

/**
 * UserMusicalTaste
 */
class UserMusicalTaste
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Component\Domain\Entity\MusicalTaste
     */
    private $idMusicalTaste;

    /**
     * @var \Component\Domain\Entity\User
     */
    private $idUser;

    /**
     * UserMusicalTaste constructor.
     * @param int $id
     * @param \Component\Domain\Entity\MusicalTaste $idMusicalTaste
     * @param \Component\Domain\Entity\User $idUser
     */
    public function __construct(\Component\Domain\Entity\MusicalTaste $idMusicalTaste, \Component\Domain\Entity\User $idUser)
    {
        $this->idMusicalTaste = $idMusicalTaste;
        $this->idUser = $idUser;
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
     * Set idMusicalTaste
     *
     * @param $idMusicalTaste
     *
     * @return UserMusicalTaste
     */
    public function setIdMusicalTaste(\Component\Domain\Entity\MusicalTaste $idMusicalTaste = null)
    {
        $this->idMusicalTaste = $idMusicalTaste;

        return $this;
    }

    /**
     * Get idMusicalTaste
     *
     * @return \Component\Domain\Entity\MusicalTaste
     */
    public function getIdMusicalTaste()
    {
        return $this->idMusicalTaste;
    }

    /**
     * Set idUser
     *
     * @param \Component\Domain\Entity\User $idUser
     *
     * @return UserMusicalTaste
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


}
