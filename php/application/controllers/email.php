<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {
	
	function index()
	{
		$this->load->helper('url');
		
		$response = new stdClass();
		$response->error = "0";
		$response->message = "Script ended unexpectedly";
		
		$fromEmail 		= "";
		$fromName 		= "";
		$toEmail 		= "";
		$toName 		= "";
		$message 		= "";
		$detailLink		= "";
		$tid			= "";
		$email_version 	= "";
		
		if( isset($_POST['from_email']) && $_POST['from_email'] != "" ){
			$fromEmail 	= $_POST['from_email'];
		}
		if( isset($_POST['from_name']) && $_POST['from_name'] != "" ){
			$fromName 	= $_POST['from_name'];
		}
		if( isset($_POST['to_email']) && $_POST['to_email'] != "" ){
			$toEmail 	= $_POST['to_email'];
		}
		if( isset($_POST['to_name']) && $_POST['to_name'] != "" ){
			$toName 	= $_POST['to_name'];
		}
		if( isset($_POST['message']) && $_POST['message'] != "" ){
			$message 	= $_POST['message'];
		}
		if( isset($_POST['tid']) && $_POST['tid'] != "" ){
			$tid = $_POST['tid'];
			$_POST['gallery_url'] = base_url()."images/gallery/large/".$tid.".jpg";
			$detailLink = INSTALLED_PAGE_URL."?app_data={%22tid%22:%22".$tid."%22}";
		}else{
			$_POST['gallery_url'] = base_url() . "images/email/girls-fpo.jpg";
			$detailLink = INSTALLED_PAGE_URL;
		}
		if( isset($_POST["version"]) ){
			$email_version 	= $_POST["version"];
			unset($_POST['version']);
		} else {
			$email_version 	= "app";
		}
		
		$_POST['subject'] 	= EMAIL_SUBJECT;
		
		$htmlBody 			= "";
		$baseUrl 			= base_url();
		
		// Build the html email
		$filePath			= getcwd()."/email_templates/share_".$email_version.".html";
		//echo $filePath;
		$file 				= fopen( $filePath, "r" );
		
		while( !feof( $file ) )
			$htmlBody = $htmlBody . fgets( $file, 4096 );
		
		fclose( $file );
		
		// Fill in dynamic values
 		$arrFind 			= array("{BASE_URL}","{NAME}", "{GALLERYIMG}","{APPLINK}", "{DETAILLINK}", "{MESSAGE}");
 		$arrReplace 		= array($baseUrl, $fromName, $_POST['gallery_url'], INSTALLED_PAGE_URL, $detailLink, $message);
 		$htmlBody 			= str_replace($arrFind, $arrReplace, $htmlBody);
		
		// Remove tid because it is not stored in the email table
		unset($_POST['tid']);
		
		// Send html email
		$this->load->library('email');
		
		$config['charset'] 	= 'iso-8859-1';
		$config['mailtype'] = 'html';
		
		$this->email->initialize($config);
		$this->email->from($fromEmail, $fromName);
		$this->email->to($toEmail, $toName);
		$this->email->subject($_POST['subject']);
		$this->email->message($htmlBody);
		
		// Store data if email was sent successfully
		$this->load->model( 'emaildata_model' );
		
		if( $this->email->send() ){
			$recordId 			= $this->emaildata_model->Add($_POST);
			$response->error 	= "1";
			$response->title 	= "YOUR EMAIL WAS SENT!";
			$response->message 	= "Thank you for sharing!";
		}else{
			$response->error 	= "-1";
			$response->title 	= "WHOOOPSY DAISY. YOUR EMAIL FAILED.";
			$response->message 	= "Please hang up and try your call again later.";
			$response->details 	= $this->email->print_debugger();;
			//echo $this->email->print_debugger();
		}
		
		//header('Content-Type: application/json'); 
		echo json_encode($response);
	}
	
	function entries($pLimit = "")
	{
		// Set WHERE params for SQL SELECT
		$selectOpts 				= array('sortBy'=>'created_at','sortDirection'=>'DESC');
		// Limit result set. Mainly used by xml output
		if( $pLimit != "" ){
			$selectOpts['offset'] 	= '0';
			$selectOpts['limit'] 	= $pLimit;
		}
		
		$this->load->model('emaildata_model');
	    
		$data['total_rows'] 		= $this->emaildata_model->Get(array('count' => true));
		$data['records'] 			= $this->emaildata_model->Get($selectOpts);
		$data['fields'] 			= $this->emaildata_model->_fields();
		$data['pk'] 				= $this->emaildata_model->_pk();
		
		if( $this->session->userdata('userEmail') ){
			$this->load->view('template/template_head');
			$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_index', $data);
			$this->load->view('template/template_foot');
		}else{
			redirect('admin/login');
		}
	}
	
	function add()
	{
		$this->load->view('template/template_head');
	    //$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_add_form');
	    $this->load->view($this->uri->segment(1).'/'.'add_view');
		$this->load->view('template/template_foot');
	}
}

?>