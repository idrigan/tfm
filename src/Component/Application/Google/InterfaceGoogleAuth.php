<?php

namespace Component\Application\Google;


interface InterfaceGoogleAuth
{
    public function getUrl();
    public  function getInfoUser();
    public function authenticate($response);
    public function getToken();
}