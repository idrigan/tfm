<?php


namespace ProfileBundle\Controller;



use Component\Domain\DTO\UserFriendDTO;
use Symfony\Component\HttpFoundation\Request;

class FriendsController extends BaseController
{

    public function execute(Request $request){

         parent::checkUser($request);

        $friendUseCase = $this->get('app.user.usecase.friendsusecase');

        $friends = $friendUseCase->execute(new UserFriendDTO($this->user['id'],TRUE));

       return  $this->renderCustomView('@ProfileBundle/Resources/views/friends.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'user'=>$this->user,
            'friends'=>$friends->getFriends()]);


    }




}