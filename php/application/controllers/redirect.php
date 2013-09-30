<?php
class Redirect extends CI_Controller {
	public function __construct()
	{
		//call parent's constuctor
		parent::__construct();
	}
	
	public function index()
	{		
		//oc: fix for ie8
		//header('p3p: CP="NOI ADM DEV PSAi COM NAV OUR OTR STP IND DEM"');
		
		
		if(isset($_GET['code'])){
			//build the auth url.
			if(isset($_SERVER["HTTPS"])){
				$url = "https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('facebook_app_id')."&redirect_uri=".ABSOLUTE_URL_SSL."redirect/&client_secret=".$this->config->item('facebook_app_secret')."&code=".$_GET['code'];
							
			}else
				$url = "https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('facebook_app_id')."&redirect_uri=".ABSOLUTE_URL."redirect/&client_secret=".$this->config->item('facebook_app_secret')."&code=".$_GET['code'];
			
			//get the auth response query string.
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
			$response_str =  curl_exec($curl);
			curl_close ($curl);			
			
			//parse the query response string.
			parse_str($response_str, $response);
			
			//append the access_token and redirect back to the facebook page.
			if (isset($response['access_token']))
				redirect(INSTALLED_PAGE_URL."?&app_data={%22access%5Ftoken%22:%22".$response['access_token']."%22}", "location", 301);
			else {
				echo "houston we have a problem, no access token\n";
				print_r("access_token url: ".$url);
				echo "\n";				
				print_r("response string: ".$response_str);					
			}//endif
		}//endif
		else if (isset($_GET['error_reason'])){
				redirect(INSTALLED_PAGE_URL);
			
		}//endifelse
	}//end function 
}//end class