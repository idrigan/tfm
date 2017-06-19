<?php

namespace AppBundle\Controller;


use ProfileBundle\Controller\BaseController;
use SpotifyWebAPI\SpotifyWebAPIException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMusicalController extends BaseController
{


    public function search(Request $request){
        try {
            $apiMusical = $this->get('api.musical');

            $data = json_decode($request->getContent(), true);

            $value = $data['value'];

            $results = $apiMusical->search($value);

            return new Response(json_encode(array("response" => "OK","data"=>$results)));
        }catch(SpotifyWebAPIException $e){
            return new Response(json_encode(array("response" => "ERROR","data"=>$e->getMessage())));
        }
    }

    public function searchMore(Request $request){

        parent::checkUser($request);

        $val = $request->query->get('val');

        $apiMusical = $this->get('api.musical');

        $result = $apiMusical->search($val,50,0);

        var_dump($result);

        return $this->render('@AppBundle/Resources/views/showMoreResults.html.twig', [
                'user' => $this->user,
                'result' => $result
            ]
        );


    }

}