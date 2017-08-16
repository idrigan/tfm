<?php

namespace ProfileBundle\Api;


use ProfileBundle\Controller\BaseController;
use ProfileBundle\Events\EventDispatcher\Friends\FriendsEvent;
use ProfileBundle\Events\EventSubscriber\FriendsEventSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SendInvitationController extends BaseController
{
    public function execute(Request $request){
        $json = json_decode($request->getContent(), true);
        $email =   $json['value'];

        //$email = "idrigan@gmail.com";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return new Response(json_encode(array("response"=>"OK","data"=>("The email is not valid"))));
        }

        $email = str_replace("@","#",$email);
        //send email
        $event = new FriendsEvent();
        $event->setEmail($email);
        $dispatcher = new EventDispatcher();
        $eventSubscriber = new FriendsEventSubscriber();
        $dispatcher->addSubscriber($eventSubscriber);
        $dispatcher->dispatch(FriendsEvent::SENDINVITATION,$event);

        return new Response(json_encode(array("response"=>"OK","data"=>("The email is sent"))));
    }


}