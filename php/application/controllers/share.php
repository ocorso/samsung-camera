<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Share extends CI_Controller {
	
	public function __construct()
	{
		//call parent's constuctor
		parent::__construct();
		
		// Ensure library/ is on include_path
		$libPath  = realpath(dirname(__FILE__)."/../libraries");
		set_include_path(get_include_path() . PATH_SEPARATOR . $libPath);
		
		/* ERROR HANDLING */
		error_reporting(E_ALL|E_STRICT);
		ini_set('display_startup_errors', 1);  
		ini_set('display_errors', 1); 
		include 'OAuth/Token.php';
		session_start();
	}
	public function index(){
		
		$data		= array('cdn'=> base_url() );

		$this->load->view("share/share_view", $data);
	}
	public function redirect(){
		
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//					UTILITY FUNCTIONS
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function reset(){
		$array_items = array('pb_oauth_token' => '', 'pb_status' => '');
		$this->session->unset_userdata($array_items);
		   session_destroy();
		   echo "session destroyed";
	}
	private function _do_upload($field)
		{
			$config['upload_path'] = 'images/gallery/temp/';
			$config['allowed_types'] = '*';
			$config['max_size']	= '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if ( ! $this->upload->do_upload($field))
			{
				$error = array('error' => $this->upload->display_errors());
				return $error;
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				return $data;
			}
		}
	private function _getFilePathByTid($tid, $prependAtSymbol = true){
			//oc: set relative path from doc root using tid.
			$galleryPath = "/images/gallery/large/$tid.jpg";
			//prepend current directory to relative path
			$img 		= $prependAtSymbol ? '@'.getcwd().$galleryPath : getcwd().$galleryPath;
			return $img;
	}
	private function _getDecodedRequestVars(){
		
		$data		= $this->input->get_post('payload');
		$params 	= json_decode(base64_decode($data), true);
		return $params;
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//					FACEBOOK FUNCTIONS
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function facebook(){
		
		//oc: get request vars 
		$params				= $this->_getDecodedRequestVars();

		//oc: init facebook sdk
		$this->_initFB($params['access_token']);
		
		//oc: put ducks in a row
		$args = array(
			'message' 	=> $params['comment'],
			'image'		=> $this->_getFilePathByTid($params['tid'])
		);

		//oc: make it rain
		$data = $this->facebook->api('/me/photos', 'post', $args);

		$params['response']	= $data;

		//oc: respond to request
		$responseToFlash	= array(
								'data'=> $data,	
								'status' =>"ready", 
								'which_api'=>"facebook"
		);			
		print_r(json_encode($responseToFlash));
	}
	private function _initFB($token = null){
		
		//oc: prepare facebook library for like-gate
		$fb_config	= array(
	    	'appId'  => $this->config->item('facebook_app_id'),
   			'secret' => $this->config->item('facebook_app_secret'),
			'cookie' => true,
			'domain'=>'dev.click3x.com'//oc: TODO change in production
		);
		
		$this->load->library('facebook', $fb_config);
		$this->facebook->setAccessToken($token);
		$this->facebook->setFileUploadSupport(true);
		
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//					PHOTOBUCKET FUNCTIONS
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	public function photobucket($isRedirect = null)
	{
		//oc: get request vars
		$params		= $this->_getDecodedRequestVars();	
		
		//oc: get this party started
		$this->_initPB();
		
		//access_token
		if ($isRedirect && isset($_SESSION['pb_request_token'])){
//echo "IS REDIRECT. close fancybox";
			$tok 			= unserialize($_SESSION['pb_request_token']);	
//print_r($tok);
			$this->pbapi->setOAuthToken($tok->getKey(), $tok->getSecret());
        	$this->pbapi->login('access')->post()->loadTokenFromResponse();
        	
        	$_SESSION['pb_access_token']= serialize($this->pbapi->getOAuthToken());
	        $_SESSION['pb_username'] 	= $this->pbapi->getUsername();
    	    $_SESSION['pb_subdomain'] 	= $this->pbapi->getSubdomain();

    	    $username		= $this->pbapi->getUsername();
        	$subdomain		= $this->pbapi->getSubdomain();
			
			$data = array(	"isRedirect"		=> "yep",
							'status' 			=> $_SESSION['pb_status'],
							'username'			=> $username,
							'subdomain'			=> $subdomain
			);
		//	print_r($data);
		}else{
		//oc: request token	
			$data		= array('cdn'=> base_url());
			
			try {
			  	$this->pbapi->login('request')->post()->loadTokenFromResponse();
				$_SESSION['pb_request_token'] = serialize($this->pbapi->getOAuthToken());
				$this->pbapi->goRedirect('login');	
			    
			} catch (PBAPI_Exception_Response $e) {
			    echo "RESPONSE $e";
			} catch (PBAPI_Exception $e) {
			    echo "EX $e";
			}
		}
		$this->load->view('share/photobucket_view', $data);
	}
	private function _initPB(){
	
		$params = array('customer_key' 		=> $this->config->item('photobucket_app_id'), 
						'customer_secret' 	=> $this->config->item('photobucket_app_secret')
		);
		
		$this->load->library('pbapi',$params);
		$this->pbapi->setResponseParser('phpserialize');
		$status				= $this->input->get_post('status', TRUE);
		if ($status) 		$_SESSION['pb_status'] 		= $status;
	}//end function
		
	public function postPhotoToPhotobucketAlbum(){
		
		//oc: get request vars
		$params		= $this->_getDecodedRequestVars();	
		
		$this->_initPB();
        $tok 		= unserialize($_SESSION['pb_access_token']);
        $username 	= $_SESSION['pb_username'];
        $subdomain 	= $_SESSION['pb_subdomain'];
        
        $imgTitle 	= $params['comment'];
        $tid		= $params['tid'];
        
        $this->pbapi->setOAuthToken($tok->getKey(), $tok->getSecret(), $username);
        $this->pbapi->setSubdomain($subdomain);
        
		$img 		= $this->_getFilePathByTid($tid);
		
		//oc: check if album exists:
		$albumParams= array("name"=>SAMSUNG_ALBUM_NAME);
		$albumResp	= $this->pbapi->album($username, $albumParams)->post();
		
		//oc: upload image to photobucket album
		$data = array(	'type' 			=> 'image', 
						'uploadfile' 	=> $img, 
						'title' 		=> $imgTitle
		);
		$resp = $this->pbapi->album($username."/".$albumParams['name'])->upload($data)->post()->getParsedResponse(true);
		$resp['which_api'] 	= "photobucket";
		$resp['result'] 	= "by golly, i think it worked";
		
		print_r(json_encode($resp));
			
	}


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//					GOOGLE PICASA FUNCTIONS
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function picasa($isRedirect = null){

		
		//oc: get request vars
		$params		= $this->_getDecodedRequestVars();	
		
		$this->load->library('picasa', $params);	

		//oc: put ducks in a row
		$pic 		= array(	'tmp_name'=> $this->_getFilePathByTid($params['tid'], false),
								'name'=>"Samsung Gallery Image",
								'comment'=> $params['comment'],
								'type'=>"image/jpeg"
		);
		
		//oc: determine albumId
		$albumId	= $this->picasa->getAlbumIdByName(SAMSUNG_ALBUM_NAME);
		if($albumId == -1)
			$albumId = $this->picasa->createAlbum(SAMSUNG_ALBUM_NAME);
		
		//oc: here's where the magic happens
		$response 	= $this->picasa->upload($albumId, $pic);
		
		//oc: give response to the request from flash
		if ($response['error'] == "nope"){
			$responseToFlash	= array(	
											'status'=>"ready", 
											'which_api'=>"picasa"
			);			
			print_r(json_encode($responseToFlash));
		}else {
			json_encode($response);
		}
		
	}//end function

	public function checkPicasaAuth(){
		
		$params		= $this->_getDecodedRequestVars();	
		
		$this->load->library('picasa', $params);	
		$this->picasa->auth();
		echo "ready";
	}
}//end class

?>