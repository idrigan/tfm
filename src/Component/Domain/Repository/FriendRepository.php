<?php


namespace Component\Domain\Repository;


use Component\Domain\Entity\User;
use Component\Domain\Entity\UserFriend;

interface FriendRepository
{
    public function getFriendsByUser($idUser);
    public function getFriendsByUserNoAccept($idUser);
    public function searchFriends($idUser,$value);
    public function addFriend(UserFriend $userFriend);
    public function getUserFriend($idUser,$idFriend);
    public function cancelFriend(UserFriend $userFriend);
}