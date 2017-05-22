<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    private $spotify;

    public function index(Request $request){


        $user = $request->getSession()->get('user');

        if ($user == null){
            return $this->redirect('/');
        }

        return $this->render('@AppBundle/Resources/views/home.html.twig', [
                'user' => $user]
        );
    }
}