<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {
	
	public function index()
	{
		$this->load->helper('url');
		
		header("Content-Type: text/xml");
		
		$data	= array(
			'cdn'		=> base_url(),
	    	'appId'  	=> $this->config->item('facebook_app_id'),
   			'secret' 	=> $this->config->item('facebook_app_secret'),
			'shortUrl'	=> $this->config->item('app_short_url')
		);

		$this->load->view('config/config_view', $data );
	}
	public function phase2()
	{
		header("Content-Type: text/xml");
		
		$data	= array(
			'cdn'		=> base_url(),
	    	'appId'  	=> $this->config->item('facebook_app_id'),
   			'secret' 	=> $this->config->item('facebook_app_secret'),
			'shortUrl'	=> $this->config->item('app_short_url')
		);

		//oc: gallery stuff
		//get model
		$this->load->model('photo_model');
		//sort
		$arrWhere = array('flag'=>0,'sortBy'=>'created_at','sortDirection'=>'DESC');
		
		//oc: featured
		$featuredWhere 		= array('featured'=>1, 'sortBy'=>'created_at', 'sortDirection'=>'DESC');
		$featuredRecord 	= $this->photo_model->Get( $featuredWhere );
		$data['featured']	= $featuredRecord[0];
		
		$data['total_images'] 	= $this->photo_model->Get( array_merge($arrWhere, array('count' => true) ) );
		$data['total_pages'] 	= ceil($data['total_images']/GALLERY_PANELS_PER_PAGE);
		
		$this->load->view('config/phase2_config_view', $data );
	}
}

?>