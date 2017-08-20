<?php

namespace Component\Domain\Entity;

/**
 * UserInResponse
 */
class UserInResponse
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ProfileBundle\Entity\Publication
     */
    private $publication;

    /**
     * @var \ProfileBundle\Entity\ResponsePublication
     */
    private $response;

    /**
     * @var \ProfileBundle\Entity\User
     */
    private $user;


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
     * Set publication
     *
     * @param \ProfileBundle\Entity\Publication $publication
     *
     * @return UserInResponse
     */
    public function setPublication(Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \ProfileBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set response
     *
     * @param \ProfileBundle\Entity\ResponsePublication $response
     *
     * @return UserInResponse
     */
    public function setResponse(ResponsePublication $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return \ProfileBundle\Entity\ResponsePublication
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set user
     *
     * @param \ProfileBundle\Entity\User $user
     *
     * @return UserInResponse
     */
    public function setUser(\ProfileBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ProfileBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
