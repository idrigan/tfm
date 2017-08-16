<?php


namespace ProfileBundle\Controller;


use Component\Domain\DTO\UserFriendDTO;
use ProfileBundle\Events\EventDispatcher\Contact\ContactEvent;
use ProfileBundle\Events\EventSubscriber\ContactEventSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends BaseController
{

    public function execute(Request $request){
        return $this->renderContactView($request);
    }


    public function send(Request $request){
        if ($request->getMethod() == 'POST'){

           $name = $request->request->get('name');
            $email = $request->request->get('email');
            $message = $request->request->get('message');

            if (empty($name) || empty($email) || empty($message)){
                $errors = "You have empty fields";
                return $this->renderContactView($request,$errors,  $name , $email, $message);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors = "The email is not valid";
                return $this->renderContactView($request,$errors, $name , $email, $message);
            }

            $this->sendEmail($name,$email,$message);

            return $this->redirect("/contact");

        }
    }


    private function renderContactView(Request $request,$errors = '', String $name = null , String $email = null, String $message = null){

        parent::checkUser($request);

        $friendUseCase = $this->get('app.user.usecase.friendsusecase');
        $friends = $friendUseCase->execute(new UserFriendDTO($this->user['id'],TRUE));

        return $this->renderCustomView('@ProfileBundle/Resources/views/contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'user'=>$this->user,
            'friends'=>$friends->getFriends(),
            'errors' => $errors,
            'name'=>$name,
            'email'=>$email,
            'message'=>$message
        ]);
    }

    private function sendEmail(String $name,String $email, String $message){
        //send email
        $event = new ContactEvent();
        $event->setData($name, $email,  $message);

        $dispatcher = new EventDispatcher();
        $eventSubscriber = new ContactEventSubscriber();
        $dispatcher->addSubscriber($eventSubscriber);
        $dispatcher->dispatch(ContactEvent::SENDCONTACT,$event);
    }
}