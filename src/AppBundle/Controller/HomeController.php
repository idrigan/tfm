<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        $user = $request->getSession()->get('user');

        return $this->render('@AppBundle/Resources/views/home.html.twig', [
                'user' => $user]
        );
    }
}