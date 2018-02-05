<?php

namespace ProfileBundle\Controller;

use Component\Domain\DTO\UserFriendDTO;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

    protected $user;

    protected function checkUser(Request $request)
    {
        $session = $request->getSession();
//	var_dump($session);exit();	
        $token = $session->get('token');

        if (!is_array($token) || count($token)==0){
            return new RedirectResponse("/home");
        }

        $this->user = array(
            'picture'=>$session->get('picture'),
            'name'=>$session->get('name'),
            'email'=>$session->get('email'),
            'id'=>$session->get('id')
        );

        if (!is_array($this->user) || count($this->user)==0){
            return new RedirectResponse("/");
        }

    }

    protected function renderCustomView($view , $data ){


        $friendUseCase = $this->get('app.user.usecase.friendsNotAcceptedusecase');

        $friends = $friendUseCase->execute(new UserFriendDTO($this->user['id'],FALSE));

        $data['notificationsFriends'] = $friends;

        return $this->render($view,$data);
    }
}
