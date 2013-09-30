<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {
	
	public function upload(){
		
		//oc: resources
		$this->load->library('FileUploader');
		$imgTools			= new FileUploader();

		//get username and fullname
		if (isset($_POST["username"]))
			$username 		= $_POST["username"];
		
		if (isset($_POST["full_name"]))
			$fullname 		= $_POST["full_name"];
		
		//oc: file info
		$isPost				= $this->input->server('REQUEST_METHOD') == 'POST';
		
		$tid 				= strtotime(date('Y-m-d H:i:s'));
		$baseUrl			= base_url();
		$upload_dir 		= "images/gallery";	 									// The directory for the images to be saved in
		$upload_path 		= $upload_dir."/";									// The path to where the image will be saved
		$large_image_prefix = "large/"; 										// The prefix name to large image
		$thumb_image_prefix = "thumb/";											// The prefix name to the thumb image
		$max_file 			= "1"; 												// Maximum file size in MB
		$max_width 			= "720";											// Max width allowed for the large image
		$thumb_width 		= "150";											// Width of thumbnail image
		$thumb_height 		= "150";											// Height of thumbnail image
		
		$response			= new stdClass();
		$response->error 	= new stdClass();
		$response->error->code 	= -1;

		$allowed_image_types = array(	'image/pjpeg',
										'image/jpeg',
										'image/jpg',
										'image/png',
										'image/x-png',
										'image/gif',
										'application/octet-stream'
		);
			
		$allowed_image_ext = array(		'jpg',
										'jpeg',
										'png',
										'gif',
										'giff',
		);
		
		#########################################################################################################
		# INIT																									#
		#########################################################################################################
		
		//set new image locations and filnames
		$file_ext 				= ".jpg";
		$large_image_name 		= $large_image_prefix.$tid;
		$thumb_image_name 		= $thumb_image_prefix.$tid;
		$large_image_location 	= $upload_path.$large_image_name.$file_ext;
		$thumb_image_location 	= $upload_path.$thumb_image_name.$file_ext;
		
		//Create the upload directory with the right permissions if it doesn't exist
		if(!is_dir($upload_dir)){
			mkdir($upload_dir, 0777);
			chmod($upload_dir, 0777);
		}
		

		#########################################################################################################
				# UPLOAD																								#
		#########################################################################################################
		
		//check to see if there's an image to upload
		if ( isset( $_POST['largeImage'])) {

			//Get the file information
	
			//Everything is ok, so we can upload the image.
			$file = base64_decode($_POST['largeImage']);  //base64_decode
  			file_put_contents($large_image_location, $file); //'images/
				
			//create the thumbnail
			if(!copy($large_image_location, $thumb_image_location)){
				$response->error->code 			= 5;
				$response->error->text 			= "UPLOAD FAILED";
				$response->error->description 	= "Thumbnail transfer failed";
			}
				
			//Get the new coordinates to crop the image.
//			$x1 = $_POST["x"];
//			$y1 = $_POST["y"];
//			$w = $_POST["w"];
//			$h = $_POST["h"];
			$x1 = 0;
			$y1 = 0;
			$w = 720;
			$h = 480;
			
			//810 × 520
			//Scale the image to the thumb_width set above
			$tscale = .25;//oc: 25%
			$cropped = $imgTools->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$tscale);
					
			//scale the large image if it is greater than the width set above
			$width = $imgTools->getWidth($large_image_location);
			$height = $imgTools->getHeight($large_image_location);
		
			if ($width > $max_width){
				$scale = $max_width/$width;
				$uploaded = $imgTools->resizeImage($large_image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = $imgTools->resizeImage($large_image_location,$width,$height,$scale);
			}
			
				//Post the entry to the database
		}//endif
		else {
				$response->error->code 				= 0;
				$response->error->text 				= "UPLOAD FAILED";
				$response->error->description 		= "Image not found";
			}
			if($isPost){
				
				//oc: save in DB
 				$imgOpts= array(
 					'tid'			=> $tid,
	 				'full_name'		=> $this->input->post('full_name'),
	 				'profile_pic'	=> $this->input->post('profile_pic'),
 					'user_id'		=> $this->input->post('user_id'),
 					'camera'		=> $this->input->post('camera'),
 					'filter'		=> $this->input->post('filter')
 				);
				$success = $this->db->insert('gallery_images', $imgOpts); 
			}//endif
		
		if($response->error->code == -1 && $isPost){
			$response->result 				= "success";
			$response->image				= new stdClass();
			$response->image->tid			= $tid;
		}else $response->result 			= "failed";
						
		$data['response']	= $response;
		$this->load->view('file/upload', $data);
		
	}//end function 

}//end class

?>