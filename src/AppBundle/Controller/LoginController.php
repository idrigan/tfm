<?php

namespace AppBundle\Controller;

use Component\Domain\Entity\User;
use DateTime;
use Google_Service_Logging;
use Google_Client;
use Google_Service_Oauth2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    private $client;
    private $oauth;
    private $session;
    private $em;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->session = new Session();

    }

    public function execute(Request $request)
    {

        $this->configureGoogleClient();
        $this->client->setRedirectUri('http://box.example.com:8000/login/check-google');
        $auth_url = $this->client->createAuthUrl();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                'auth_url' => $auth_url]
        );
    }

    public function responseGoogle(Request $request)
    {

        try {
            if (null == $request->getSession()) {

                $this->session->start();
            }

            $this->configureGoogleClient();

            $response = $request->query->get('code');

            $this->client->authenticate($response);

            if (null ==  $this->client->getAccessToken()){
                return $this->redirect('/');

            }

            $this->session->set("token", $this->client->getAccessToken());

            $infoUser = $this->oauth->userinfo_v2_me->get();

            $this->updateUser($infoUser->getEmail());

            $dataUser = array(
                'email' => $infoUser->getEmail(),
                'name' => $infoUser->getName(),
                'picture' => $infoUser->getPicture(),
                'locale' => $infoUser->getLocale()
            );

            $this->session->set('user', $dataUser);

            return $this->redirect('/home');

        }catch(Exception $e){

            $this->redirect($this->generateUrl('url'));
        }
    }

    private function configureGoogleClient()
    {

        $file = $this->getParameter('kernel.root_dir') . $this->getParameter('client_secrets');


        $this->client->setAuthConfig($file);
        $this->client->setAccessType("offline");
        $this->client->setIncludeGrantedScopes(true);
        $this->client->addScope(Google_Service_Logging::CLOUD_PLATFORM_READ_ONLY);
        $this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));

        $this->oauth = new Google_Service_Oauth2($this->client);

    }

    private function updateUser($email){

        $user = new User();
        $useCase = $this->get('app.user.usecase.getuser');

        $data =  $useCase->execute($email);

        if ( count($data) == 0 ){
            $user->setEmail($email);
        }
        $date = new DateTime();
        $date->format("Y-m-d H:i:s");
        $user->setLastConnect($date);
        $user->setNick("");

        $this->saveUser($user);

    }

    private function saveUser(User $user){

        $this->em = $this->getDoctrine()->getManager();


        $useCase = $this->get('app.user.usecase.createuser');
        $useCase->execute($user);
        $this->em->flush();
    }
}
