<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/admin
	 *	- or -  
	 * 		http://example.com/index.php/admin/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/admin/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function Main()
	{
		parent::Controller();
		$this->load->model('user_model');
	}
	
	function login()
	{
		$this->load->model('user_model');
		$this->form_validation->set_rules('userEmail', 'email', 'trim|required|valid_email|callback__check_login');
		$this->form_validation->set_rules('userPassword', 'password', 'trim|required');
		
		//if($this->form_validation->run())
		//{
			// the form has successfully validated
			if($this->user_model->Login(array('userEmail' => $this->input->post('userEmail'), 'userPassword' => $this->input->post('userPassword'))))
			{
				redirect('users/index');
			} //redirect('admin/login');
		//}
		
		$this->load->view('template/template_head');
		$this->load->view('admin/admin_login_form');
		$this->load->view('template/template_foot');
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/index');
	}
	
	function index()
	{
		if( $this->session->userdata('userEmail') ){
			redirect('users/index');
		} else {
			$this->load->view('template/template_head');
			$this->load->view('admin/admin_index');
			$this->load->view('template/template_foot');
		}
	}
	
	function _check_login($userEmail)
	{
		$this->load->model('user_model');
		if($this->input->post('userPassword'))
		{
			$user = $this->user_model->GetUsers(array('userEmail' => $userEmail, 'userPassword' => md5($this->input->post('userPassword'))));
			if($user) return true;
		}
		
		$this->form_validation->set_message('_check_login', 'Your username / password combination is invalid.');
		return false;
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */