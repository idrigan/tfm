<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function execute(){

        $user = $this->session->get('user');

        return $this->render('default/home.html.twig', [
                'user' => $user]
        );
    }
}