<?php
namespace LoginBundle\Controller;


use Component\Application\Oauth\InterfaceOAuth;
use Component\Domain\DTO\UserDTO;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{

    public function index(Request $request)
    {

        $session = $request->getSession();

        $oauth = $this->get('login.oauth');

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

        $session->set("token", $this->getToken($oauth));

        $response = $this->createUpdateUser($user);

        $message = $response->getMessage();

        foreach ($message as $index => $value){
            $session->set($index,$value);
        }

        return new RedirectResponse($response->getUrl());

    }

    private function getAuthUrl(InterfaceOAuth $interGoogleAuth)
    {

        return $interGoogleAuth->getUrl();
    }

    private function authenticate(InterfaceOAuth $interGoogleAuth, $response)
    {
        return $interGoogleAuth->authenticate($response);
    }

    private function getToken(InterfaceOAuth $interGoogleAuth)
    {
        return $interGoogleAuth->getToken();
    }

    private function createUpdateUser(UserDTO $userDTO)
    {
        $loginUseCase = $this->get('app.user.usecase.loginusecase');
		
        return $loginUseCase->execute($userDTO);
    }
}
