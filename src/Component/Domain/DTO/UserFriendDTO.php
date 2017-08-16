<?php


namespace Component\Domain\DTO;


use Component\Domain\Entity\User;

class UserFriendDTO
{

    private $idUser;
    private $friends;
    private $accepted;

    public function __construct($idUser,$accepted =0)
    {
        $this->idUser = $idUser;
        $this->accepted = $accepted;
        $this->friends = array();
    }

    /**
     * @return mixed
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * @param mixed $accepted
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return array
     */
    public function getFriends(): array
    {
        return $this->friends;
    }

    /**
     * @param array $friends
     */
    public function setFriends(array $friends)
    {
        $this->friends = $friends;
    }

    public function addFriend(User $user){
        $this->friends[] = $user;
    }


}