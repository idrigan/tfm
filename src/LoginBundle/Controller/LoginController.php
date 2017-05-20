<?php
namespace LoginBundle\Controller;

use Component\Application\Google\InterfaceGoogleAuth;
use Component\Domain\DTO\UserDTO;
use LoginBundle\Resources\config\doctrine\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{

    public function index()
    {

        $oauth = $this->get('login.oauth');

        // replace this example code with whatever you need
        return $this->render('@LoginBundle/Resources/views/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'auth_url' => $this->getAuthUrl($oauth)

        ]);
    }

    public function response(Request $request)
    {

        $oauth = $this->get('login.oauth');

        $user = $this->authenticate($oauth, $request->query->get('code'));

        if (null == $user) {
            return $this->redirect('/');
        }

        $session = $request->getSession();

        $session->set("user",$user);
        $session->set("token", $this->getToken($oauth));

        $this->createUpdateUser($user);

        return $this->redirect("/home");

    }

    private function getAuthUrl(InterfaceGoogleAuth $interGoogleAuth)
    {

        return $interGoogleAuth->getUrl();
    }

    private function authenticate(InterfaceGoogleAuth $interGoogleAuth, $response)
    {
        return $interGoogleAuth->authenticate($response);
    }

    private function getToken(InterfaceGoogleAuth $interGoogleAuth)
    {
        return $interGoogleAuth->getToken();
    }

    private function createUpdateUser(UserDTO $userDTO)
    {
        $getUserUseCase = $this->get('app.user.usecase.getuser');

        $user = $getUserUseCase->execute($userDTO->getEmail());

        $em = $this->getDoctrine()->getManager();

        if (count($user) > 0){
            $this->updateUser($user[0]);
        }else{
            $this->createUser($userDTO);
        }

        $em->flush();
    }

    private function updateUser(User $user){
        $userUpdateCase = $this->get('app.user.usecase.updateuser');


        $date = new DateTime();
        $date->format("Y-m-d H:i:s");

        $user->setDateCreate($date);

        $userUpdateCase->execute($user);
    }

    private function createUser(UserDTO $userDTO){
        $userCreateCase = $this->get('app.user.usecase.createuser');

        $date = new DateTime();
        $date->format("Y-m-d H:i:s");

        $user = new User($userDTO->getEmail(),$date);

        $user = $userCreateCase->execute($user);

    }
}