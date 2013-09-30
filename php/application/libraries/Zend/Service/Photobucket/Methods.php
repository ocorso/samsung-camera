<?php

require_once 'Zend/Service/Photobucket.php';

abstract class Zend_Service_Photobucket_Methods {

    protected $_core;

    public function __construct(Zend_Service_Photobucket $core) {
        $this->_core = $core;
    }

    public function callMethod($method, $path, array $args = array(), $responseType = null) {
        return $this->_core->callMethod($method, $path, $args, $responseType);
    }

}
