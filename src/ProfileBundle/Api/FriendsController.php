<?php


namespace ProfileBundle\Api;



use Component\Domain\DTO\UserDTO;
use Component\Domain\DTO\UserFriendDTO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FriendsController extends Controller
{

    public function search(Request $request){
        $idUser = $request->getSession()->get('id');

        if (empty($idUser)){
            return new Response(json_encode(array("response"=>"Error","data"=>"No se ha encontrado ningún usuario")));
        }

        $json = json_decode($request->getContent(), true);

        $value = $json['value'];
        $limit = $json['limit'];

        $searchFriendUseCase = $this->get('app.user.usecase.searchfriendsusecase');

        $friends = $searchFriendUseCase->execute((int)$idUser,$value);

        return new Response(json_encode(array("response"=>"OK","data"=>($friends))));
    }

    public function add($id,Request $request){

        $idUser = $request->getSession()->get('id');

        if (empty($idUser)){
            throw $this->createNotFoundException('No user logged in');
        }

        $addFriendUseCase = $this->get('app.user.usecase.addfriendusecase');

        $userFriendDTO = new UserFriendDTO($idUser);

        $userCase = $this->get('app.user.usecase.getuser');

        $userDto = new UserDTO();
        $userDto->setId($id);

        $userFriend = $userCase->getById($userDto);

        $userFriendDTO->addFriend($userFriend);

        if (!$addFriendUseCase->execute($userFriendDTO)){
            throw $this->createNotFoundException('No exist the user');
        }else{
            return $this->redirect("/friends");
        }
    }
}