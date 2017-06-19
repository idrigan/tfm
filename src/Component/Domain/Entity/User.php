<?php

namespace Component\Domain\Entity;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $dateCreate;

    /**
     * @var string
     */
    private $nick;


    public function __construct($email,$dateCreate)
    {
       $this->email  = $email;
       $this->dateCreate = $dateCreate;
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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return User
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

    }

    /**
     * Get username
     *
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    public function setId($id){
        $this->id = $id;
    }
}
