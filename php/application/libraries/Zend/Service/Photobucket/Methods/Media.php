<?php

class Zend_Service_Photobucket_Methods_Media extends Zend_Service_Photobucket_Methods 
{

    public function get($url) 
    {
        return $this->callMethod('GET', '/media/'.rawurlencode($url));
    }

    public function getTitle($url)
    {
        return $this->callMethod('GET', '/media/'.rawurlencode($url).'/title');
    }
    public function setTitle($url, $title)
    {
        return $this->callMethod('POST', '/media/'.rawurlencode($url).'/title',
                           array('title'=>$title));
    }

    public function getDescription($url)
    {
        return $this->callMethod('GET', '/media/'.rawurlencode($url).'/description');
    }
    public function setDescription($url, $desc)
    {
        return $this->callMethod('POST', '/media/'.rawurlencode($url).'/description',
                           array('description'=>$desc));
    }

    public function getTag($url, $tagid=false)
    {
    }
    public function addTag($url, $params) 
    {

    }
    public function updateTag($url, $tagid, $params)
    {
    }
    public function deleteTag($url, $tagid) 
    {
    }

    public function getComments($url, $paging=array())
    {
        return $this->callMethod('GET', '/media/'.rawurlencode($url).'/comment', $paging);
    }
    public function addComment($url, $comment, $parseonly=false)
    {
        if (!$comment) throw new Exception('required comment');
        $params['comment'] = $comment;
        if ($parseonly) $params['parseonly'] = 1;
        return $this->callMethod('POST', '/media/'.rawurlencode($url).'/comment', $params);
    }

    public function getRatings($url)
    {
        return $this->callMethod('GET', '/media/'.rawurlencode($url).'/rating');
    }
    public function addRating($url, $rating) 
    {
    }
    public function resize($url, $size)
    {
    }
    public function rotate($url, $degrees)
    {
    }

    public function getMeta($url)
    {
    }
    public function getGeo($url)
    {
    }
    public function updateGeo($url, $params)
    {
    }
    public function deleteGeo($url)
    {
    }
    public function getLinks($url)
    {
        return $this->callMethod('GET', '/media/'.rawurlencode($url).'/link');
    }
    public function getRelated($url, $num=5, $type='images')
    {
    }
    public function rename($url, $filename, $albumname=null)
    {
    }

    public function delete($url)
    {
    }
    public function share($url, $services='all', $message=null, $email=null)
    {
        if (is_array($services)) $services = implode(',', $services);

        if ($message) $args['message'] = $message;
        if ($email) $args['email'] = $email;
        return $this->callMethod('POST', '/media/'.rawurlencode($url).'/share/'.$services, $args);
    }

}

