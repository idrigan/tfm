<?php

namespace AppBundle\Controller;


use Component\Domain\DTO\CommentDTO;
use Component\Domain\DTO\ResponseCommentDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\Publication;
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

    public function addResponse(Request $request){

        parent::checkUser($request);

        $data = json_decode($request->getContent(), true);
        $data = $data['value'];
        if (count($data) != 2){
            return new Response(json_encode(array("response" => "ERROR","data"=>"Incorrect parameters")));
        }

        $idCommnet = $data[0];
        $comment = $data[1];

        if (empty($idCommnet) || empty($comment)){
            return new Response(json_encode(array("response" => "ERROR","data"=>"No data")));
        }


        $userDTO = new UserDTO();
        $userDTO->setId($this->user['id']);

        $userUseCase = $this->get('app.user.usecase.getuser');
        $userData = $userUseCase->getById($userDTO);

        $publicatioUseCase = $this->get('app.comment.usecase.getbyid');

        $publication = $publicatioUseCase->execute(new CommentDTO($idCommnet));

        $responseComment = new ResponseCommentDTO($publication,$comment,$userData);

       $responsePublicationUseCase = $this->get('app.comment.save.response');

       if ($responsePublicationUseCase->execute($responseComment)){
           return new Response(json_encode(array("response" => "OK","data"=>"The comment was saved successfully")));
       }else{
           return new Response(json_encode(array("response" => "ERROR","data"=>"Error to save response")));
       }

    }

}