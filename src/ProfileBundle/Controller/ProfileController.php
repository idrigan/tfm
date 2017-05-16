<?php


namespace ProfileBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ProfileController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function profile(){

        $user = $this->session->get('user');

        return $this->render('default/profile.html.twig', [
                'user' => $user]
        );
    }

}