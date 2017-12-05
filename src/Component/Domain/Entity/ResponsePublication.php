<?php

namespace Component\Domain\Entity;

/**
 * ResponsePublication
 */
class ResponsePublication
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $typeContent;

    /**
     * @var \DateTime
     */
    private $dateCreate;

    /**
     * @var \DateTime
     */
    private $dateUpdate;

    /**
     * @var \DateTime
     */
    private $dateRemove;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \ProfileBundle\Entity\Publication
     */
    private $idPublication;

    /**
     * @var \ProfileBundle\Entity\User
     */
    private $idUser;


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
     * Set content
     *
     * @param string $content
     *
     * @return ResponsePublication
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set typeContent
     *
     * @param string $typeContent
     *
     * @return ResponsePublication
     */
    public function setTypeContent($typeContent)
    {
        $this->typeContent = $typeContent;

        return $this;
    }

    /**
     * Get typeContent
     *
     * @return string
     */
    public function getTypeContent()
    {
        return $this->typeContent;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return ResponsePublication
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
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     *
     * @return ResponsePublication
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set dateRemove
     *
     * @param \DateTime $dateRemove
     *
     * @return ResponsePublication
     */
    public function setDateRemove($dateRemove)
    {
        $this->dateRemove = $dateRemove;

        return $this;
    }

    /**
     * Get dateRemove
     *
     * @return \DateTime
     */
    public function getDateRemove()
    {
        return $this->dateRemove;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return ResponsePublication
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set idPublication
     *
     * @param \ProfileBundle\Entity\Publication $idPublication
     *
     * @return ResponsePublication
     */
    public function setIdPublication(Publication $idPublication = null)
    {
        $this->idPublication = $idPublication;

        return $this;
    }

    /**
     * Get idPublication
     *
     * @return \ProfileBundle\Entity\Publication
     */
    public function getIdPublication()
    {
        return $this->idPublication;
    }

    /**
     * Set idUser
     *
     * @param \ProfileBundle\Entity\User $idUser
     *
     * @return ResponsePublication
     */
    public function setIdUser(User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \ProfileBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
