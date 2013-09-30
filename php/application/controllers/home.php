<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	protected $_isLocal;
	protected $_likeStatus;
	protected $_appData = array("overwrite this");
	protected $_fb_config;
	protected $_signed_request;
	protected $_loginUrl;
	protected $_access_token;
	
	/**
	 * Constructor for this controller.
	 * ensures that every view is behind the like-gate
	 * 
	 */
	public function __construct()
	{
		//call parent's constuctor
		parent::__construct();
		
		//oc: fix for ie8
		header('p3p: CP="NOI ADM DEV PSAi COM NAV OUR OTR STP IND DEM"');

		//oc: prepare facebook library
		$this->_fb_config	= array(
	    	'appId'  => $this->config->item('facebook_app_id'),
   			'secret' => $this->config->item('facebook_app_secret'),
			'cookie' => true,
			'domain'=>'dev.click3x.com'
		);
		
		$this->load->library('facebook', $this->_fb_config);
		$this->_signed_request 	= $this->facebook->getSignedRequest();
		
		//oc: appData
		if( !empty($this->_signed_request) && !empty($this->_signed_request['app_data']) ){
			$this->_appData = json_decode(urldecode($this->_signed_request['app_data']));			
						
		}
		if(isset($this->_appData->access_token)){
			$this->_access_token = $this->_appData->access_token;
			$this->session->set_userdata('oauth_token', $this->_appData->access_token );
		}
		//+++++++++++++++++++++++++++++++++++++++++
		//oc: oAuth at front of app
		//+++++++++++++++++++++++++++++++++++++++++

		//get the login url in case we don't have auth yet.
		$authParams = array(	'redirect_uri' => base_url()."redirect/",
								'scope'=>'publish_stream,user_photos,user_likes'
		);
		$this->_loginUrl = $this->facebook->getLoginUrl($authParams);
		
		$this->_fb_config['login_url'] = $this->_loginUrl;
		
		//try and get the auth token from facebook first.
		$this->_access_token = $this->facebook->getAccessToken();
		
		//if the facebook didn't give the token check for it in the signed request. 
		//else if the signed request didn't have it try and get it from the cookie.
		if( !isset($this->_access_token) && isset($this->_signed_request['oauth_token']) )
			$this->_access_token = $this->_signed_request['oauth_token'];
		else
			$this->_access_token= $this->session->userdata('oauth_token');
		
		//if we have an auth token save it to the cookie.
		if( !empty($this->_access_token) )
			$this->session->set_userdata('oauth_token', $this->_access_token);
		//+++++++++++++++++++++++++++++++++++++++++
		//oc: oAuth END
		//+++++++++++++++++++++++++++++++++++++++++

		
		
		//oc: like status
		if( isset($this->_signed_request['page']["liked"]) ){
			$this->_likeStatus = $this->_signed_request["page"]["liked"];
			$this->session->set_userdata('like_status', $this->_likeStatus);
		} else {
			$this->_likeStatus = $this->session->userdata('like_status');
		}
		
 		//oc: determine if we need to worry about this nonsense (like gate).
 		$this->_isLocal = (ENVIRONMENT != "production" && ENVIRONMENT != "cfm_staging" );
		
 		$this->_fb_config['like_status']	= $this->_likeStatus;
 		$this->_fb_config['like_url'] 		= $this->config->item('facebook_like_url'); 
	}//end constructor
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//oc: data for the view
		$data	= array(
			'cdn'		=> base_url(),
//oc: this loads preloader
			'swf'		=> "Preloader.swf",
//oc: this loads the app directly
//			'swf'		=> "SamsungCamera.swf",
	    	'appId'  	=> $this->config->item('facebook_app_id'),
   			'secret' 	=> $this->config->item('facebook_app_secret'),
			'appData'	=> $this->_appData,
			'loginUrl'	=> $this->_loginUrl	
		);
		
//oc: Redirect from app page.
		if(isset($_SERVER['HTTP_REFERER'])){
			if(strpos($_SERVER['HTTP_REFERER'], "apps.facebook.com")){
				$data['appRedirect'] = INSTALLED_PAGE_URL;
				$this->load->view('home/app_redirect_view', $data);
				return;
			}
		}
		
//oc: Like gate.		
//		if ($this->_isLocal || $this->_likeStatus){
if(true){
		$this->load->view('home/header_view', $data);
			$this->load->view('home/flash_view', $data);
			$this->load->view('home/footer_view', $data);
		} else
			$this->load->view('home/like_gate', $data);

	}//end function
	
	public function redirect(){
		//oc: data for the view
		$data	= array('login_url'	=> $this->_loginUrl	);
		$this->load->view('home/redirect_view', $data);
	}//end function
	
}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */