<?php

class Zend_Service_Photobucket_Methods_Group extends Zend_Service_Photobucket_Methods 
{

    public function get($album, $params = array()) 
    {
        return $this->callMethod('GET', '/group/'.rawurlencode($album), $params);
    }

    public function getUrl($album)
    {
        return $this->callMethod('GET', '/group/'.rawurlencode($album).'/url');
    }

    public function upload($album, $filename, $params=array())
    {
        return $this->_core->callUpload('/group/'.rawurlencode($album).'/upload', $filename, $params);
    }

    public function create($album, $params) 
    {
        return $this->callMethod('POST', '/group/'.rawurlencode($album), $params);
    }

    public function getInfo($album) {
        return $this->callMethod('GET', '/group/'.rawurlencode($album).'/info');
    }
    public function setInfo($album, $params) {
        return $this->callMethod('POST', '/group/'.rawurlencode($album).'/info', $params);
    }

    public function getContributor($album, $contrib=false) {
        $url = '/group/'.rawurlencode($album).'/contributor';
        if ($contrib) $url .= '/'.$contrib;
        return $this->callMethod('GET', $url);
    }

    public function follow($album, $type, $email=false)
    {
        $args = array();
        if ($email) $args['email'] = $email;
        return $this->callMethod('POST', '/group/'.rawurlencode($album).'/follow/'.$type, $args);
    }
    public function unFollow($album, $type, $subscription_id)
    {
        $args = array('user_subscription_id' => $subscription_id);
        return $this->callMethod('DELETE', '/group/'.rawurlencode($album).'/follow/'.$type, $args);
    }
    public function getFollowingStatus($album, $type = null, $email = false)
    {
        $url = '/group/'.rawurlencode($album).'/follow';
        if ($type) $url .= '/'.$type;

        $args = array();
        if ($email) $args['email'] = $email;
        return $this->callMethod('GET', $url, $args);
    }
    public function getPrivacy($album)
    {
        return $this->callMethod('GET', '/group/'.rawurlencode($album).'/privacy');
    }
    public function setPrivacy($album, $privacy, $password=null) 
    {
        $args = array('privacy'=>$privacy);
        if ($privacy == 'private') $args['password'] = $password;
        return $this->callMethod('POST', '/group/'.rawurlencode($album).'/privacy', $args);
    }
    public function getVanityUrl($album)
    {
        return $this->callMethod('GET', '/group/'.rawurlencode($album).'/vanity');
    }
    public function getTheme($album)
    {
        return $this->callMethod('GET', '/group/'.rawurlencode($album).'/theme');
    }
    public function share($url, $services='all', $message=null, $email=null)
    {
        if (is_array($services)) $services = implode(',', $services);

        if ($message) $args['message'] = $message;
        if ($email) $args['email'] = $email;
        return $this->callMethod('POST', '/group/'.urlencode($url).'/share/'.$services, $args);
    }

    public function getTags($album, $tagname=null, $params=array())
    {
        $url = '/group/'.rawurlencode($album).'/tag';
        if ($tagname) $url .= '/'.rawurlencode($tagname);

        return $this->callMethod('GET', rtrim($url, '/'), $params);
    }

}


