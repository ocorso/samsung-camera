<?php

class Zend_Service_Photobucket_Methods_User extends Zend_Service_Photobucket_Methods 
{

    public function get($username=null) {
        if (!$username && $this->_core->getUsername()) {
            $username = $this->_core->getUsername();
        }
        if (!$username) {
            $username = '-';
        }

        return $this->callMethod('GET', '/user/'.$username);
    }

    public function search($username=null, $term=null, $params=array()) 
    {
        if (!$username && $this->_core->getUsername()) {
            $username = $this->_core->getUsername();
        }
        if (!$username) {
            $username = '-';
        }
        $url = '/user/'.rawurlencode($username).'/search';
        if ($term) $url .= '/'.rawurlencode($term);

        return $this->callMethod('GET', rtrim($url, '/'), $params);
    }

    public function getContacts($username)
    {
    }
    public function getTags($username, $tagname=null, $params=array())
    {
        if (!$username && $this->_core->getUsername()) {
            $username = $this->_core->getUsername();
        }
        if (!$username) {
            $username = '-';
        }
        $url = '/user/'.rawurlencode($username).'/tag';
        if ($tagname) $url .= '/'.rawurlencode($tagname);

        return $this->callMethod('GET', rtrim($url, '/'), $params);
    }

    public function getUploadOptions($username)
    {
    }
    public function setUploadOptions($username, $params)
    {
    }

    public function getUrl($username=null) 
    {
        if (!$username && $this->_core->getUsername()) {
            $username = $this->_core->getUsername();
        }
        if (!$username) {
            $username = '-';
        }

        return $this->callMethod('GET', '/user/'.$username.'/url');
    }

    public function getGroups($username=null)
    {
    }

    public function getFollowing($username=null, $type=null)
    {
    }

    public function getFollowingMedia($username, $type=null)
    {
    }

    public function getUsernameAvailability($username) 
    {
    }

    public function register($username, $params)
    {
    }

    public function getShareConnections($username, $service=null) {
        return $this->callMethod('GET', '/user/'.$username.'/share');
    }
}

