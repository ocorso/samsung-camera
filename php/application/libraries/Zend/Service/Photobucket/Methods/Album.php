<?php

class Zend_Service_Photobucket_Methods_Album extends Zend_Service_Photobucket_Methods 
{

    public function get($album, $params = array()) 
    {
        return $this->callMethod('GET', '/album/'.rawurlencode($album), $params);
    }

    public function getUrl($album)
    {
        return $this->callMethod('GET', '/album/'.rawurlencode($album).'/url');
    }

    public function upload($album, $filename, $params=array())
    {
        return $this->_core->callUpload('/album/'.rawurlencode($album).'/upload', $filename, $params);
    }

    public function create($album, $name) 
    {
        return $this->callMethod('POST', '/album/'.rawurlencode($album), 
                           array('name'=>$name));
    }

    public function rename($album, $name) 
    {
        return $this->callMethod('PUT', '/album/'.rawurlencode($album), 
                           array('name'=>$name));

    }
    public function delete($album) 
    {
        return $this->callMethod('DELETE', '/album/'.rawurlencode($album));
    }

    public function getOrganize($album)
    {
        return $this->callMethod('GET', '/album/'.rawurlencode($album).'/organize');
    }
    public function setOrganize($album, $order_type = 'ascending', array $order=null)
    {
        $args = array('order_type' => $order_type);
        if ($order_type == 'manual') {
            $args['order'] = $order;
        }
        return $this->callMethod('POST', '/album/'.rawurlencode($album).'/organize', $args);
    }
    public function follow($album, $type, $email=false)
    {
        $args = array();
        if ($email) $args['email'] = $email;
        return $this->callMethod('POST', '/album/'.rawurlencode($album).'/follow/'.$type, $args);
    }
    public function unFollow($album, $type, $subscription_id)
    {
        $args = array('user_subscription_id' => $subscription_id);
        return $this->callMethod('DELETE', '/album/'.rawurlencode($album).'/follow/'.$type, $args);
    }
    public function getFollowingStatus($album, $type = null, $email = false)
    {
        $url = '/album/'.rawurlencode($album).'/follow';
        if ($type) $url .= '/'.$type;

        $args = array();
        if ($email) $args['email'] = $email;
        return $this->callMethod('GET', $url, $args);
    }
    public function getPrivacy($album)
    {
        return $this->callMethod('GET', '/album/'.rawurlencode($album).'/privacy');
    }
    public function setPrivacy($album, $privacy, $password=null) 
    {
        $args = array('privacy'=>$privacy);
        if ($privacy == 'private') $args['password'] = $password;
        return $this->callMethod('POST', '/album/'.rawurlencode($album).'/privacy', $args);
    }
    public function getVanityUrl($album)
    {
        return $this->callMethod('GET', '/album/'.rawurlencode($album).'/vanity');
    }
    public function getTheme($album)
    {
        return $this->callMethod('GET', '/album/'.rawurlencode($album).'/theme');
    }
    public function share($url, $services='all', $message=null, $email=null)
    {
        if (is_array($services)) $services = implode(',', $services);

        if ($message) $args['message'] = $message;
        if ($email) $args['email'] = $email;
        return $this->callMethod('POST', '/album/'.urlencode($url).'/share/'.$services, $args);
    }

}


