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

        $searchFriendTasteMusicalUseCase = $this->get('app.user.usecase.searchfriendsmusicaltastesusecase');

        $friends_musical_taste = $searchFriendTasteMusicalUseCase->execute((int)$idUser,$value);

        $friends = array_merge($friends,$friends_musical_taste);

        return new Response(json_encode(array("response"=>"OK","data"=>($friends))));
    }

    public function add($idUserFriend,Request $request){

        $idUser = $request->getSession()->get('id');


        if (empty($idUser)){
            return $this->redirect('/');
        }

        if (empty($idUserFriend)){
            throw $this->createNotFoundException('No exist the user');
        }

        $addFriendUseCase = $this->get('app.user.usecase.addfriendusecase');

        $userFriendDTO = new UserFriendDTO($idUser);

        $userCase = $this->get('app.user.usecase.getuser');

        $userDto = new UserDTO();
        $userDto->setId($idUserFriend);

        $userFriend = $userCase->getById($userDto);

        $userFriendDTO->addFriend($userFriend);

        if (!$addFriendUseCase->execute($userFriendDTO)){
            throw $this->createNotFoundException('No exist the user');
        }else{
            if ($request->getMethod() == "GET"){
              return $this->redirect('/friends');
            } else {
                return new Response(json_encode(array("response" => "OK", "data" => ("The friend is accept"))));
            }
        }
    }

    public function cancel($idUserFriend,Request $request){
        $idUser = $request->getSession()->get('id');

        if (empty($idUser)){
            return $this->redirect('/');
        }

        if (empty($idUserFriend)){
            throw $this->createNotFoundException('No exist the user');
        }

        $cancelFriendUseCase = $this->get('app.user.usecase.cancelfriendusecase');

        $userFriendDTO = new UserFriendDTO($idUser);

        $userCase = $this->get('app.user.usecase.getuser');

        $userDto = new UserDTO();
        $userDto->setId($idUserFriend);

        $userFriend = $userCase->getById($userDto);

        $userFriendDTO->addFriend($userFriend);

        if (!$cancelFriendUseCase->execute($userFriendDTO)){
            throw $this->createNotFoundException('Can not remove friend');
        }else{
            return new Response(json_encode(array("response"=>"OK","data"=>("The friend is not accept"))));
        }
    }


}