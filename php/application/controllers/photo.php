<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller
{	
    // Retrieve
	function index()
	{
		$this->load->model('photo_model');	    
		
		$data['total_rows'] = $this->photo_model->Get(array('count' => true));
		$data['records'] = $this->photo_model->Get(array('sortBy'=>'created_at','sortDirection'=>'DESC','limit'=>100));	
		
		$data['fields'] = $this->photo_model->_fields();
		$data['pk'] = $this->photo_model->_pk();
		
		if( $this->session->userdata('userEmail') ){
			$this->load->view('template/template_head');
			$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_index', $data);
			$this->load->view('template/template_foot');
		}else{
			redirect('admin/login');
		}
	}
	
	function csv($pFormat="html")
	{
		$this->load->model('photo_model');
	    
		$data['total_rows'] = $this->photo_model->Get(array('count' => true));
		$data['records'] = $this->photo_model->Get(array('sortBy'=>'created_at','sortDirection'=>'ACS'));
		$data['fields'] = $this->photo_model->_fields();
		$data['pk'] = $this->photo_model->_pk();
		
		$header = "";
		$filedata = "";
		foreach($data['records'][0] as $name=> $value)
		{
		    $header .= $name . "\t";
		}
		
		foreach($data['records'] as $row)
		{
		    $line = '';
		    foreach( $row as $value )
		    {                                            
		        if ( ( !isset( $value ) ) || ( $value == "" ) )
		        {
		            $value = "\t";
		        }
		        else
		        {
		            $value = str_replace( '"' , '""' , $value );
		            $value = '"' . $value . '"' . "\t";
		        }
		        $line .= $value;
		    }
		    $filedata .= trim( $line ) . "\n";
		}
		$filedata = str_replace( "\r" , "" , $filedata );
		
		if ( $filedata == "" )
		{
		    $filedata = "\n(0) Records Found!\n";                        
		}
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$this->uri->segment(1)."_export.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header\n$filedata";
	}
	
	 // Retrieve
	function recordcount($pFormat="html")
	{
		$this->load->model('photo_model');
	    
		$data['total_rows'] = $this->photo_model->Get(array('count' => true));
		$data['fields'] = $this->photo_model->_fields();
		$data['pk'] = $this->photo_model->_pk();
		
		if($pFormat == "html"){
			//$this->load->view('template/template_head');
			//$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_index', $data);
			//$this->load->view('template/template_foot');
			redirect($this->uri->segment(1));
		}elseif($pFormat == "xml"){
			$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_count_xml', $data);
		}
	}
	
	function paginated($offset = 0)
	{
		$this->load->model('photo_model');
	    $this->load->library('pagination');
	    
	    $perpage = 10;
		
	    $config['base_url'] = base_url() . $this->uri->segment(1).'/index/';
	    $config['total_rows'] = $this->photo_model->Get(array('count' => true));
	    $config['per_page'] = $perpage;
	    $config['uri_segment'] = 3;
	    
	    $this->pagination->initialize($config);
	    
	    $data['pagination'] = $this->pagination->create_links();
	    
		$data[$this->uri->segment(1)] = $this->photo_model->Get(array('sortBy'=>'order','sortDirection'=>'ASC','limit' => $perpage, 'offset' => $offset));
		$data['fields'] = $this->photo_model->_fields();
		$data['pk'] = $this->photo_model->_pk();
		
		$this->load->view('template/template_head');
		$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_paginated', $data);
		$this->load->view('template/template_foot');
	}
	
	function details($pFormat="html", $pId){
		$this->load->model('photo_model');
		
		$data['record'] = $this->photo_model->Get(array('flashDataId'=>$pId));
		
		$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_details_xml', $data);
		$data['fields'] = $this->photo_model->_fields();
		$data['pk'] = $this->photo_model->_pk();
	}
	
	// Update
	function edit($recordId)
	{
		$this->load->model('photo_model');
		$data['record'] = $this->photo_model->Get(array($this->photo_model->_pk() => $recordId));
	    if(!$data['record']) redirect($this->uri->segment(1));
		
		// Validate form
	    $this->form_validation->set_rules('photoUserName', 'name', 'trim|required');
	    
	    if($this->form_validation->run())
		{
	        // Validation passes
	        $_POST[$this->photo_model->_pk()] = $recordId;
	        
	        if($this->photo_model->Update($_POST))
	        {
	            $this->session->set_flashdata('flashConfirm', 'The user has been successfully updated.');
	            redirect($this->uri->segment(1));
	        }
	        else
	        {
                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
	            redirect($this->uri->segment(1));
	        }
	    }
		
		$this->load->view('template/template_head');
		$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_edit_form', $data);
		$this->load->view('template/template_foot');
	}
	
	// Delete
	function delete($recordId)
	{
		$this->load->model('photo_model');
	    $data['record'] = $this->photo_model->Get(array($this->photo_model->_pk() => $recordId));
	    if(!$data['record']) redirect($this->uri->segment(1));
	    
	    $this->photo_model->Delete($recordId);
	    
	    $this->session->set_flashdata('flashConfirm', 'The user has been successfully deleted.');
	    redirect($this->uri->segment(1));
	}
	
	function flag($recordId)
	{
		$this->load->model('photo_model');
		
        // Set up the querydata
        $_POST[$this->photo_model->_pk()] = $recordId;
                
        if($this->photo_model->Update($_POST))
        {
            redirect($this->uri->segment(1).'/index/html');
        }
        else
        {
            redirect($this->uri->segment(1).'/index/html');
        }
	}
	
	function feature($recordId)
	{
		$this->load->model('photo_model');
	
		// Set up the querydata
		$_POST[$this->photo_model->_pk()] = $recordId;
	
		if($this->photo_model->Update($_POST))
		{
			redirect($this->uri->segment(1).'/index/html');
		}
		else
		{
			redirect($this->uri->segment(1).'/index/html');
		}
	}

}