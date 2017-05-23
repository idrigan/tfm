<?php


namespace AppBundle\Controller;


use AppBundle\Api\ApiMusical;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    private $spotify;

    public function index(Request $request){

        $this->spotify = $this->get('api.musical');

        $user = array(
            'picture'=>$request->getSession()->get('picture'),
            'name'=>$request->getSession()->get('name'),
            'email'=>$request->getSession()->get('email'),
        );


        if ($user == null){
            return $this->redirect('/');
        }

        return $this->render('@AppBundle/Resources/views/home.html.twig', [
                'user' => $user]
        );
    }
}