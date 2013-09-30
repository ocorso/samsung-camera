<?php

class Zend_Service_Photobucket_Methods_Search extends Zend_Service_Photobucket_Methods 
{

    public function search($term, $type='image', $params=array())
    {
        return $this->callMethod('GET', '/search/'.rawurlencode($term).'/'.$type, $params);
    }

    public function getFeatured($type='homepage')
    {
        return $this->callMethod('GET', '/featured/'.$type);
    }

    public function getFindstuffCategories($name='') 
    {
        return $this->callMethod('GET', rtrim('/findstuff/'.rawurlencode($name),'/'));
    }

    public function getFindstuffCategoryMedia($name)
    {
        return $this->callMethod('GET', '/findstuff/'.rawurlencode($name).'/category');
    }

    public function follow($term, $email=null)
    {
    }

    public function unFollow($term, $user_subscription_id=null)
    {
    }

    public function getFollowingStatus($term, $email=null)
    {
    }

}
