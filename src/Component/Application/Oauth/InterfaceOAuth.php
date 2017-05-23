<?php

namespace Component\Application\Oauth;


interface InterfaceOAuth
{
    public function getUrl();
    public  function getInfoUser();
    public function authenticate($response);
    public function getToken();
}