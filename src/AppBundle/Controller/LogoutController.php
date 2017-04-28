<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function execute()
    {
        $this->session->clear();
        return $this->redirect('/');
    }
}