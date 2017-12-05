<?php


namespace ProfileBundle\Controller;


use Component\Domain\DTO\UserDTO;
use Component\Domain\DTO\UserFriendDTO;
use Symfony\Component\HttpFoundation\Request;

class ProfileController  extends BaseController
{

    public function execute(Request $request){

        parent::checkUser($request);

        $userDTO = new UserDTO();
        $userDTO->setId($this->user['id']);

        $userUseCase = $this->get('app.user.usecase.getuser');
        $userData = $userUseCase->getById($userDTO);

        $friendUseCase = $this->get('app.user.usecase.friendsusecase');
        $friends = $friendUseCase->execute(new UserFriendDTO($this->user['id'],TRUE));

        return $this->renderCustomView('@ProfileBundle/Resources/views/profile.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                'userData' => $userData,
                'user'=>$this->user,
                'friends'=>$friends->getFriends()
        ]);
    }

}