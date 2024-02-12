<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class site_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->settings = $this->ideate_model->get_settings();
		$this->load->model('admin/admin_model');
	}

	public function send_mail($mailTo, $mailSubject, $mailContent, $mailFromEmail, $mailFromName, $attachments=[]){
		if (!empty(trim($mailTo))) {
			$mail_service = $this->settings['site_email_service'];
			if ($mail_service == 2) {
				$smtp_host = $this->settings['site_smtp_host'];
				$smtp_port = $this->settings['site_smtp_port'];
				$smtp_username = $this->settings['site_smtp_username'];
				$smtp_password = base64_decode($this->settings['site_smtp_password']);
				$config['protocol'] = "smtp";
				$config['smtp_host'] = $smtp_host;
				$config['smtp_port'] = $smtp_port;
				$config['smtp_user'] = $smtp_username;
				$config['smtp_pass'] = $smtp_password;
				$config['validation'] = TRUE;
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";
				$this->email->initialize($config);
			}
			$this->email->from($mailFromEmail, $mailFromName);
			$this->email->to($mailTo);
			$this->email->subject($mailSubject);
			$this->email->message($mailContent);

			if(!empty($attachments) && count($attachments) > 0){
				foreach ($attachments as $attachment) {
					$this->email->attach($attachment);
				}
			}

			if(ENVIRONMENT == 'development'){
				set_error_handler(function($errno, $errstr, $errfile, $errline) {
					// error was suppressed with the @-operator
					if (0 === error_reporting()) {
						return false;
					}
					
					throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
				});

				try {
					return true;
				} catch (ErrorException $e) {
					// echo $e->getMessage();
				}
			}else{
				if ($this->email->send()) {
					return true;
				} else {
					//Failed to send email
					// die($this->email->print_debugger());
				}
			}
		}
		return false;
	}
}