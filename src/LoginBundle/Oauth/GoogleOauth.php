<?php


namespace LoginBundle\Oauth;


use Component\Application\Google\InterfaceGoogleAuth;
use Component\Domain\DTO\UserDTO;
use Exception;
use Google_Client;
use Google_Service_Logging;
use Google_Service_Oauth2;

class GoogleOauth implements InterfaceGoogleAuth
{

    private $client;
    private $oauth;

    private $rootDirClientSecrets;


    public function __construct($rootDirClientSecrets)
    {
        $this->client = new Google_Client();

        $this->rootDirClientSecrets = $rootDirClientSecrets;

        $this->config();


        //TODO: get parameter
        $url = 'http://box.example.com:8000/login/check-google';

        $this->client->setRedirectUri($url);
    }

    public function config()
    {

        try{
            $this->client->setAuthConfig($this->rootDirClientSecrets);

            $this->client->setAccessType("offline");
            $this->client->setIncludeGrantedScopes(true);
            $this->client->addScope(Google_Service_Logging::CLOUD_PLATFORM_READ_ONLY);

            $this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));

            $this->oauth = new Google_Service_Oauth2($this->client);
        }catch (Exception $e){
           // echo $e->getMessage();

        }


    }

    public function getInfoUser()
    {

        return $this->oauth->userinfo_v2_me->get();
    }

    public function getUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function getToken()
    {
        return $this->client->getAccessToken();
    }

    public function authenticate($response)
    {
        $this->client->authenticate($response);

        if (null == $this->client->getAccessToken()) {
            return null;

        }

        $user = $this->oauth->userinfo_v2_me->get();

        return  new UserDTO($user->email, $user->givenName." ".$user->familyName, $user->picture, $user->locale, $user->id);



    }
}