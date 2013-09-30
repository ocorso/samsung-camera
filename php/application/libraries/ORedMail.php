<?php 

class ORedMail{
	public function __construct(){
		
	}//end constructor
	
	public function send($data){
		
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		
		$this->email->initialize($config);
		$this->email->from($data['fromEmail'], $data['fromName']);
		$this->email->to($data['toEmail']);
		$this->email->cc($data['carbonEmail']);
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		$this->email->send();
		
		echo $this->email->print_debugger();
	}

	public function createMessage($msg, $img = null){
		$header = "<html><body>";
		$body	= "$msg <br />";
		if ($img) $body .= "<a href='$img' title='Click to view Gallery'>Click to view gallery</a>";
		$footer = "</body></html>";
		$return = $header.$body.$footer;
		return $return;
	}
}//end class
?>