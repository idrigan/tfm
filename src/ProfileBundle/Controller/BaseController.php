<?php

namespace ProfileBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

    protected $user;

    protected function checkUser(Request $request)
    {
        $session = $request->getSession();

        $token = $session->get('token');

        if (!is_array($token) || count($token)==0){
            return new RedirectResponse("/");
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
}