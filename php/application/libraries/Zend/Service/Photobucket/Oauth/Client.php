<?php

require_once 'Zend/Oauth/Client.php';
require_once 'Zend/Oauth.php';
require_once 'Zend/Uri/Http.php';

class Zend_Service_Photobucket_Oauth_Client extends Zend_Oauth_Client {

    function getSigUriString() {
        $uri = clone $this->getUri();
        if (!($uri instanceof Zend_Uri_Http)) {
            $uri = Zend_Uri_Http::fromString($uri);
        }
        $uri->setHost('api.photobucket.com');
        return $uri->__toString();
    }

    /**
     * Performs OAuth preparation on the request before sending.
     *
     * This primarily means taking a request, correctly encoding and signing
     * all parameters, and applying the correct OAuth scheme to the method
     * being used.
     *
     * @return void
     * @throws Zend_Oauth_Exception If POSTBODY scheme requested, but GET request method used; or if invalid request scheme provided
     */
    public function prepareOauth()
    {
        $requestScheme = $this->getRequestScheme();
        $requestMethod = $this->getRequestMethod();
        $query = null;
        if ($requestScheme == Zend_Oauth::REQUEST_SCHEME_HEADER) {
            $params = array();
            if (!empty($this->paramsGet)) {
                $params = array_merge($params, $this->paramsGet);
                $query  = $this->getToken()->toQueryString(
                    $this->getSigUriString(), $this->_config, $params
                );
            }
            if (!empty($this->paramsPost)) {
                $params = array_merge($params, $this->paramsPost);
                $query  = $this->getToken()->toQueryString(
                    $this->getSigUriString(), $this->_config, $params
                );
            }
            $oauthHeaderValue = $this->getToken()->toHeader(
                $this->getSigUriString(), $this->_config, $params
            );
            $this->setHeaders('Authorization', $oauthHeaderValue);
        } elseif ($requestScheme == Zend_Oauth::REQUEST_SCHEME_POSTBODY) {
            if ($requestMethod == self::GET) {
                require_once 'Zend/Oauth/Exception.php';
                throw new Zend_Oauth_Exception(
                    'The client is configured to'
                    . ' pass OAuth parameters through a POST body but request method'
                    . ' is set to GET'
                );
            }
            $raw = $this->getToken()->toQueryString(
                $this->getSigUriString(), $this->_config, $this->paramsPost
            );
            $this->setRawData($raw);
            $this->paramsPost = array();
        } elseif ($requestScheme == Zend_Oauth::REQUEST_SCHEME_QUERYSTRING) {
            $params = array();
            $query = $this->getUri()->getQuery();
            if ($query) {
                $queryParts = split('&', $this->getUri()->getQuery());
                foreach ($queryParts as $queryPart) {
                    $kvTuple = split('=', $queryPart);
                    $params[$kvTuple[0]] = 
                        (array_key_exists(1, $kvTuple) ? $kvTuple[1] : NULL);
                }
            }

            $query = $this->getToken()->toQueryString(
                $this->getSigUriString(), $this->_config, $params
            );
            $this->getUri()->setQuery($query);
            $this->paramsGet = array();
        } else {
            require_once 'Zend/Oauth/Exception.php';
            throw new Zend_Oauth_Exception('Invalid request scheme: ' . $requestScheme);
        }
    }

}

