<?php

namespace LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutController extends Controller
{

    public function execute(Request $request)
    {
        $request->getSession()->clear();
        return $this->redirect('/');
    }
}