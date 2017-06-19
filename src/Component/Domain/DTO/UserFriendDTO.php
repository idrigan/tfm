<?php


namespace Component\Domain\DTO;


use Component\Domain\Entity\User;

class UserFriendDTO
{

    private $idUser;
    private $friends;

    public function __construct($idUser)
    {
        $this->idUser = $idUser;
        $this->friends = array();
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