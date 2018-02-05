<?php


namespace Component\Application\User\UseCases;


use Component\Domain\DTO\UserFriendDTO;
use Component\Domain\Repository\FriendRepository;
use Doctrine\ORM\EntityManager;

class FriendsNotAcceptedUseCase
{
    private $repository;
    private $em;

    public function __construct(FriendRepository $repository,EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function execute(UserFriendDTO $userFriendDTO){

        if (empty($userFriendDTO->getIdUser())){
            return FALSE;
        }

        $friends = $this->repository->getFriendsByUserNoAccept($userFriendDTO->getIdUser());
        if (count($friends) > 0) {
            foreach ($friends as $index => $friend) {
                $email = isset($friend['email']) ? $friend['email'] : '';
                if (empty($email)) continue;
                $data = file_get_contents('http://picasaweb.google.com/data/entry/api/user/' . $email . '?alt=json');
                $data = json_decode($data);
                $avatar = $data->{'entry'}->{'gphoto$thumbnail'}->{'$t'};
                $friends[$index]['image'] = $avatar;

            }
            $userFriendDTO->setFriends($friends);
        }


        return $userFriendDTO;

    }
}