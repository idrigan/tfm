<?php


namespace AppBundle\Spotify;


use Component\Application\Spotify\InterfaceSpotify;
use SpotifyWebAPI\SpotifyWebAPI;

class Spotify implements InterfaceSpotify
{
    private $spotify;

    public function __construct()
    {
        $this->spotify = new SpotifyWebAPI\Session(
            'af6985a4f9964c51b8f95483777fe44c',
            'e3f007a7de8e487999d19b4ccf30c300',
            'http://box.example.com:8000/login/check-spotify'
        );

        $this->authorize();
    }

    private function authorize(){
      header('Location: ' . $this->spotify->getAuthorizeUrl());
    }
}