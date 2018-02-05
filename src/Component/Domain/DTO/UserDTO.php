<?php

namespace Component\Domain\DTO;

class UserDTO
{
  private $email;
  private $name;
  private $nick;
  private $picture;
  private $locale;
  private $id;

    /**
     * UserDTO constructor.
     * @param $email
     * @param $name
     * @param $picture
     * @param $locale
     * @param $id
     */
    public function __construct($email = '', $name = '', $picture = '', $locale = '', $id = '')
    {
        $this->email = $email;
        $this->name = $name;
        $this->picture = $picture;
        $this->locale = $locale;
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @return mixed
     */
    public function setNick($nick)
    {
        $this->name = $nick;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}