<?php

require_once 'Zend/Service/Photobucket/Methods.php';
require_once 'Zend/Oauth/Token/Access.php';
require_once 'Zend/Oauth/Token/Request.php';
require_once 'Zend/Service/Photobucket/Oauth/Http/RequestToken.php';
require_once 'Zend/Service/Photobucket/Oauth/Http/AccessToken.php';

class Zend_Service_Photobucket_Methods_Login extends Zend_Service_Photobucket_Methods 
{

    public function __construct($username, $password, $hashed=false) {
        $args = array('password' => $password);
        if ($hashed) $args['hashed'] = 1;
        return $this->callMethod('POST', '/login/direct/'.$username, $args);
    }

    public function directToken($username, $password, $hashed=false) {
        $info = $this->direct($username, $password, $hashed);
        if ($info->status == Zend_Service_Photobucket::STATUS_OK
            && ($this->_core->getResponseType() == Zend_Service_Photobucket::RESPONSE_TYPE_JSON
                || $this->_core->getResponseType() == Zend_Service_Photobucket::RESPONSE_TYPE_XML)
            ) {

            $token = new Zend_Oauth_Token_Access();
            $token->setToken((string)$info->content->oauth_token);
            $token->setTokenSecret((string)$info->content->oauth_token_secret);
            $this->_core->setToken($token);

            $this->_core->setUsername((string)$info->content->username);
            $this->_core->getUri()->setHost((string)$info->content->subdomain);

            return $token;
        }

        return false;
    }

    public function request() {
        $consumer = $this->_core->getOauthConsumer();
        $request = $consumer->getRequestToken(null, 'POST',
            new Zend_Service_Photobucket_Oauth_Http_RequestToken($consumer));
        return $request;
    }

    public function access(array $get, Zend_Oauth_Token_Request $req) {
        $consumer = $this->_core->getOauthConsumer();
        $access = $consumer->getAccessToken($get, $req, 'POST',
            new Zend_Service_Photobucket_Oauth_Http_AccessToken($consumer));
        return $access;
    }
    public function accessToken(array $get, Zend_Oauth_Token_Request $req) {
        $access = $this->access($get, $req);
        $this->_core->setToken($access);

        //todo parse from access token response
        $this->_core->setUsername((string)$access->username);
        $this->_core->getUri()->setHost((string)$access->subdomain);

        return $access;
    }

    public function getRedirectUrl($token = null) {
        return $this->_core->getOauthConsumer()->getRedirectUrl(null, $token);
    }

}
