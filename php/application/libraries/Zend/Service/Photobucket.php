<?php
/**
 * Photobucket Service API Client
 *
 */

require_once 'Zend/Service/Abstract.php';
require_once 'Zend/Oauth.php';
require_once 'Zend/Oauth/Client.php';
require_once 'Zend/Oauth/Consumer.php';
require_once 'Zend/Oauth/Token/Access.php';
require_once 'Zend/Service/Photobucket/Oauth/Client.php';
require_once 'Zend/Service/Photobucket/Exception.php';
require_once 'Zend/Uri.php';
require_once 'Zend/Json.php';
require_once 'Zend/Service/Photobucket/Methods.php';

class Zend_Service_Photobucket extends Zend_Service_Abstract 
{

    /**
     * Local HTTP Client cloned from statically set client
     * @var Zend_Http_Client
     */
    protected $_localHttpClient;

    /**
     * URI of Photobucket's REST API
     * @var         string      $api
     */
    protected static $_api_url = 'http://api.photobucket.com';

    /**
     * currently logged in username
     * @var         string      $_username
     */
    protected $_username;

    /**
     * Zend_Uri of this web service
     * @var Zend_Uri_Http
     */
    protected $_uri = null;

    /**
     * Current OAuth Token
     * @var Zend_Oauth_Token_Access
     */
    protected $_token = null;

    /**
     * response type processed by the code
     * @var string
     */
    protected $_response_type = self::RESPONSE_TYPE_JSON;

    public static $baseOauthOptions = array('requestScheme' => Zend_Oauth::REQUEST_SCHEME_HEADER, 
                                            'version' => '1.0', 
                                            'signatureMethod' => 'HMAC-SHA1', 
                                            'requestTokenUrl' => 'http://api.photobucket.com/login/request', 
                                            'accessTokenUrl' => 'http://api.photobucket.com/login/access', 
                                            'userAuthorizationUrl' => 'http://photobucket.com/apilogin/login', 
                                           );
    protected $_oauthOptions = array();

    const RESPONSE_TYPE_JSON = 'json';
    const RESPONSE_TYPE_XML = 'xml';

    const STATUS_OK = 'OK';

    /**
     * Construct 
     * 
     * @param string $key API key
     * @param string $secret API secret
     *
     * @return void
     */
    public function __construct(array $oauth_opts, $token = null) {
        $this->setOauthOptions($oauth_opts);

        //automatically set up http client
        $client = new Zend_Service_Photobucket_Oauth_Client($this->getOauthOptions(), 
                                                            self::$_api_url);
        $client->setConfig(array('strictredirects' => true));
        $this->setLocalHttpClient($client);

        if (!$token) $token = new Zend_Oauth_Token_Access();
        $this->setToken($token);

        $this->setUri(self::$_api_url);
    }

    public function setOauthOptions(array $opts, $no_base = false) {
        if ($no_base) $this->_oauthOptions = $opts;
        else $this->_oauthOptions = array_merge(self::$baseOauthOptions, $opts);
        if (!empty($this->_oauthOptions['appId'])) {
            $this->setAppId($this->_oauthOptions['appId']);
        }
        return $this;
    }
    public function getOauthOptions() {
        return $this->_oauthOptions;
    }
    public function getOauthConsumer() {
        return new Zend_Oauth_Consumer($this->getOauthOptions());
    }

    /**
     * setLocalHttpClient 
     * 
     * @param Zend_Oauth_Client $client client to use
     * @return self
     */
    public function setLocalHttpClient(Zend_Oauth_Client $client) {
        $this->_localHttpClient = $client;
        return $this;
    }

    /**
     * getLocalHttpClient 
     * 
     * @return Zend_Oauth_Client
     */
    public function getLocalHttpClient() {
        return $this->_localHttpClient;
    }

    /**
     * set User name
     * 
     * @param string $username 
     * @return self
     */
    public function setUsername($username) {
        $this->_username = $username;
        return $this;
    }

    /**
     * get User name 
     * 
     * @return string
     */
    public function getUsername() {
        return $this->_username;
    }

    public function setToken($token = null) {
        if ($token !== null && !($token instanceof Zend_Oauth_Token_Access)) {
            throw new Zend_Service_Photobucket_Exception('Bad Token');
        }
        $this->_token = $token;
        $this->getLocalHttpClient()->setToken($token);
        return $this;
    }

    public function getToken() {
        return $this->_token;
    }

    /**
     * Set the URI to use in the request
     *
     * @param string|Zend_Uri_Http $uri URI for the web service
     * @return Zend_Rest_Client
     */
    public function setUri($uri) {
        if ($uri instanceof Zend_Uri) {
            $this->_uri = $uri;
        } else {
            $this->_uri = Zend_Uri::factory($uri);
        }

        return $this;
    }

    /**
     * Retrieve the current request URI object
     *
     * @return Zend_Uri_Http
     */
    public function getUri() {
        return $this->_uri;
    }

    public function setResponseType($type) {
        $this->_response_type = $type;
        return $this;
    }
    public function getResponseType($override = null) {
        if ($override) return $override;
        return $this->_response_type;
    }

    /**
     * Call method 
     * 
     * Any formal error encountered is thrown as an exception.
     * 
     * @param mixed $method HTTP Method to call
     * @param array $path   path to call
     * @param array $args   Arguments to send
     * @param bool $responeseType if json or xml, will be parsed automatically
     *
     * @return string response
     */
    public function callMethod($method, $path, $args = array(), $responseType = null) {
        $this->_prepare($path);
        $args['format'] = $this->getResponseType($responseType);

        $client = $this->getLocalHttpClient();
        $client->setMethod($method);

        switch ($method) {
            case Zend_Oauth_Client::GET:
            case Zend_Oauth_Client::PUT:
            case Zend_Oauth_Client::DELETE:
                $client->setParameterGet($args);
                break;
            case Zend_Oauth_Client::POST:
                $client->setParameterPost($args);
                break;
        }

        try {
            $response = $client->request($method);
        } catch (Exception $e) {
            throw new Zend_Service_Photobucket_Exception($e->getMessage(), $e->getCode());
        }

        return $this->parseResponse($response->getBody(), $responseType);
    }

    public function callUpload($path, $files, array $args = array(), $responseType = null) {
        $this->_prepare($path);
        $args['format'] = $this->getResponseType($responseType);

        $client = $this->getLocalHttpClient();
        $client->setMethod('POST');

        $client->setParameterPost($args);
        if (!is_array($files)) {
            $files = array('uploadfile'=>$files);
        }
        foreach ($files as $name => $fn) {
            $client->setFileUpload($fn, $name);
        }

        try {
            $response = $client->request('POST');
        } catch (Exception $e) {
            throw new Zend_Service_Photobucket_Exception($e->getMessage(), $e->getCode());
        }

        return $this->parseResponse($response->getBody(), $responseType);
    }

    /**
     * parseResponse 
     * 
     * Parses the raw response from Myspace
     *
     * @param string $responseBody Response text unparsed
     * @param string $responseType format of response expected to parse
     *
     * @return mixed Parsed response
     */
    protected function parseResponse($responseBody, $responseType = null) {
        $responseType = $this->getResponseType($responseType);

        switch ($responseType) {
            case self::RESPONSE_TYPE_JSON:
                $result = Zend_Json::decode($responseBody, Zend_Json::TYPE_OBJECT);
                break;
            case self::RESPONSE_TYPE_XML:
                $result = simplexml_load_string($responseBody);
                break;
            case self::RESPONSE_TYPE_PHP:
                $result = unserialize($responseBody);
                break;
            default:
                //unknown type
                $result = $responseBody;
        }

        return $result;
    }

    /**
     * Update arguments
     * 
     * Updates the arguments with
     * * response type
     * * URL
     *
     * @param string $method Method being called
     * @param string $path path being called
     * @param array $args  Arguments being sent
     *
     * @return self
     */
    protected function _prepare($path) {
        //set path
        $uri = $this->getUri();
        $uri->setPath(rtrim($path,'/'));
        $uri->setQuery('');

        $this->getLocalHttpClient()->resetParameters()->setUri($uri);
        return $this;
    }

    public function __get($name) {
        $name = strtolower($name);
        return $this->loadMethods($name);
    }

    protected $_knownMethodClasses = array();
    public function setMethodClass($name, Zend_Service_Photobucket_Methods $obj) {
        $name = strtolower($name);
        $this->_knownMethodClasses[$name] = $obj;
        return $this;
    }

    public function loadMethods($name) {
        $name = strtolower($name);
        if (!empty($this->_knownMethodClasses[$name])) return $this->_knownMethodClasses[$name];

        $class = $this->getMethodsClassName($name);
        require_once $this->getMethodsClassPath($name);

        return $this->_knownMethodClasses[$name] = new $class($this);
    }

    protected function getMethodsClassPath($name) {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Photobucket' 
            . DIRECTORY_SEPARATOR . 'Methods' 
            . DIRECTORY_SEPARATOR . ucfirst($name) . '.php';
    }

    protected function getMethodsClassName($name) {
        return __CLASS__ . '_Methods_' . ucfirst($name);
    }

    public function ping(array $params = array(), $method = 'GET') {
        return $this->callMethod($method, '/ping', $params);
    }
    public function time() {
        $client = $this->getLocalHttpClient();
        $client->setMethod(Zend_Oauth_Client::GET);

        try {
            $response = $client->request(Zend_Oauth_Client::GET);
        } catch (Exception $e) {
            throw new Zend_Service_Photobucket_Exception($e->getMessage(), $e->getCode());
        }

        return $response->getBody();
    }
}

