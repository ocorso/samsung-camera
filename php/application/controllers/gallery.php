<?php
class Gallery extends CI_Controller {	
	public function index($pPage = 0)
	{		
		//get model
		$this->load->model('photo_model');
		
		//sort
		$arrWhere = array('flag'=>0,'sortBy'=>'created_at','sortDirection'=>'DESC');
		$arrWhereIn = array();
		
		//filter by filter
		$currTag = $this->session->userdata('tagName');
		
		switch ($currTag){
			case "dual_view":
				$arrWhere['camera'] = 'dv300f';
				break;
			case "long_zoom":
				$arrWhere['camera'] = 'wb150f';
				break;
			case "friends":
				$savedFriends = $this->session->userdata('friends');
				
				if( empty($savedFriends) ){
					$friendsData = json_decode(file_get_contents('https://graph.facebook.com/'.$this->session->userdata('user_id').'/friends?access_token='.$this->session->userdata('access_token')));
					$friendsObjects = $friendsData->data;
					
					$friendIds = array();
					foreach($friendsObjects as $friendObject)
						array_push($friendIds, $friendObject->id);
					
					$this->session->set_userdata('friends', serialize($friendIds) );
				}
				
				$arrWhereIn['user_id'] = unserialize($this->session->userdata('friends'));				
				break;
			case "mine":
				$arrWhere['user_id'] = $this->session->userdata('user_id');
				break;
		}
		
		$data['total_rows'] = $this->photo_model->Get( array_merge($arrWhere, array('count' => true) ) );
		
		//Now Filter by current page
		$arrWhere['offset'] = $pPage*GALLERY_PANELS_PER_PAGE;
		$arrWhere['limit'] = GALLERY_PANELS_PER_PAGE;
		
		$data['records'] = $this->photo_model->Get( $arrWhere, $arrWhereIn );
		
		$data['current_page'] = $pPage;
		$data['total_pages'] = ceil($data['total_rows']/GALLERY_PANELS_PER_PAGE);
		$featuredWhere = array('featured'=>1, 'sortBy'=>'created_at', 'sortDirection'=>'DESC');
		$data['featured'] = $this->photo_model->Get( $featuredWhere );
		$this->load->view('gallery/gallery_view', $data);
		
		return;
	}
	
	public function Filter($pTag ="", $userId = "", $access_token = ""){
		$this->session->set_userdata('tagName', $pTag);
		if(!empty($userId))
			$this->session->set_userdata('user_id', $userId);
		if(!empty($access_token))
			$this->session->set_userdata('access_token', $access_token);
		$this->Page(0);
	}
	
	public function detail($tid){
		$this->load->helper('url');
		$query 	= $this->db->get_where('gallery_images', array('tid' => $tid));
		$result	= $query->result();
		$data 	= array(	'cdn'=> base_url(),
							'image'=>$result[0],
							'appId'=> $this->config->item('facebook_app_id')
		);
		$this->load->view('gallery/detail_view', $data);
	}
	public function redirect($tid){
		$this->load->helper('url');
		$query 	= $this->db->get_where('gallery_images', array('tid' => $tid));
		$result	= $query->result();
		$data 	= array(	'isRedirect'=>true,
							'cdn'=> base_url(),
							'image'=>$result[0],
							'appId'=> $this->config->item('facebook_app_id')
		);
		$this->load->view('gallery/detail_view', $data);
	}
	
	public function Page($pPage = 0){
		header("Content-Type: text/xml");
		
		//get model
		$this->load->model('photo_model');
		
		//sort
		$arrWhere = array('flag'=>0,'sortBy'=>'created_at','sortDirection'=>'DESC');
		$arrWhereIn = array();
		
		//filter by filter
		$currTag = $this->session->userdata('tagName');
		
		switch ($currTag){
			case "dual_view":
				$arrWhere['camera'] = 'dv300f';
				break;
			case "long_zoom":
				$arrWhere['camera'] = 'wb150f';
				break;
			case "friends":
				$savedFriends = $this->session->userdata('friends');
				
				if( empty($savedFriends) ){
					$friendsData = json_decode(file_get_contents('https://graph.facebook.com/'.$this->session->userdata('user_id').'/friends?access_token='.$this->session->userdata('access_token')));
					$friendsObjects = $friendsData->data;
					
					$friendIds = array();
					foreach($friendsObjects as $friendObject)
						array_push($friendIds, $friendObject->id);
					
					$this->session->set_userdata('friends', serialize($friendIds) );
				}
				
				$arrWhereIn['user_id'] = unserialize($this->session->userdata('friends'));				
				break;
			case "mine":
				$arrWhere['user_id'] = $this->session->userdata('user_id');
				break;
		}
		
		$data['total_rows'] = $this->photo_model->Get( array_merge($arrWhere, array('count' => true) ), $arrWhereIn);
		
		//Now Filter by current page
		$arrWhere['offset'] = $pPage*GALLERY_PANELS_PER_PAGE;
		$arrWhere['limit'] = GALLERY_PANELS_PER_PAGE;
		
		$data['records'] = $this->photo_model->Get( $arrWhere, $arrWhereIn );
		
		$data['current_page'] = $pPage;
		$data['total_pages'] = ceil($data['total_rows']/GALLERY_PANELS_PER_PAGE);
		
		$this->load->view('gallery/config_view', $data);
	}
}