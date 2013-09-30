<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sweepstakes extends CI_Controller {

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
		//oc: TODO determine if we're allowed to enter the sweepstakes
		$isSweepstakesAllowed = true;
		$data		= array(	
						'cdn'		=> base_url()
						
					);
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

	if($isSweepstakesAllowed){
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('sweepstakes/sweepstakes_view', $data);
		}
		else
		{
			$this->load->view('sweepstakes/success_view');
		}
		
			$this->load->view('sweepstakes/sweepstakes_view', $data);
			
		} else echo "<h1>No sweepstakes offered at this time.</h1>";

	}//end function
}//end class