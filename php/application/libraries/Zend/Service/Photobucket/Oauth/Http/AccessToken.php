<?php

require_once 'Zend/Oauth/Http/AccessToken.php';

class Zend_Service_Photobucket_Oauth_Http_AccessToken extends Zend_Oauth_Http_AccessToken {

      /**
     * Assemble all parameters for an OAuth Access Token request.
     *
     * @return array
     */
    public function assembleParams()
    {
        $params = array(
            'oauth_consumer_key'     => $this->_consumer->getConsumerKey(),
            'oauth_nonce'            => $this->_httpUtility->generateNonce(),
            'oauth_signature_method' => $this->_consumer->getSignatureMethod(),
            'oauth_timestamp'        => $this->_httpUtility->generateTimestamp(),
            'oauth_token'            => $this->_consumer->getLastRequestToken()->getToken(),
            'oauth_version'          => $this->_consumer->getVersion(),
        );

        if (!empty($this->_parameters)) {
            $params = array_merge($params, $this->_parameters);
        }

        $params['oauth_signature'] = $this->_httpUtility->sign(
            $params,
            $this->_consumer->getSignatureMethod(),
            $this->_consumer->getConsumerSecret(),
            $this->_consumer->getLastRequestToken()->getTokenSecret(),
            $this->_preferredRequestMethod,
            $this->getSigUriString()
        );

        return $params;
    }

    function getSigUriString() {
        $uri = Zend_Uri_Http::fromString($this->_consumer->getAccessTokenUrl());
        $uri->setHost('api.photobucket.com');
        return $uri->__toString();
    }

}

