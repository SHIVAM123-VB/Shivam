<?php

class account extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('cart_model');
}

	public function index(){
		$pageData = [];
		
		if($this->session->userdata('sessUserId') == 0  || $this->session->userdata('sessUserId') == ""){
			redirect(base_url()."account/login");
		}
		$pageData['browserTitle'] = 'Account';
		$cartDetails = $this->cart_model->cartDetails(2);
		if($cartDetails['success'] == 1){
			$pageData['data']['cartDetails'] = $cartDetails['data'];
		}
		$pageData['data']['username'] =  $this->session->userdata('sessUserFname');
		$this->load->view('account',['pageData'=>	$pageData]);
	}
	public function login(){
		$pageData = [];
		if($this->session->has_userdata('sessUserId')){
			redirect(base_url());
		}
		$pageData['browserTitle'] = 'Login';
	
		$this->load->view('login',array('pageData'=>$pageData));
	}
		
	public function register(){
		$pageData = [];
		if($this->session->has_userdata('sessUserId')){
			redirect(base_url());
		}
		$pageData['browserTitle'] = 'Register';
		$this->load->view('register',array('pageData'=>$pageData));
	}

	public function signup_process(){
		
		$result = array("success"=>0,"error"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('fname','First Name','required|trim|max_length[40]|alpha',[
				'alpha'=>"Please Enter Only Characters."
			]);
			$this->form_validation->set_rules('lname','Last Name','required|trim|max_length[40]|alpha',[
				'alpha'=>"Please Enter only Characters."
			]);
			$this->form_validation->set_rules('email','Email','required|trim|is_unique[users.email]|min_length[6]|max_length[50]|valid_email|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]',[
				'is_unique' => 'The email already exists.'
			]);
			$this->form_validation->set_rules('phone','Phone Number','required|trim|exact_length[10]|numeric|regex_match[/^[6789]\d{9}$/]');
			$this->form_validation->set_rules('pass','Password','required|trim|min_length[6]|max_length[20]');
			
			if($this->form_validation->run() == true){
					$record = [];
					$record['fname'] = $this->input->post('fname'); 
					$record['lname'] = $this->input->post('lname'); 
					$record['email'] = $this->input->post('email'); 	
					$record['phone'] = $this->input->post('phone'); 
					$password = trim($this->input->post('pass'));
					if($password <> ""){
						$record['password'] = md5($password); 
					}  
					$result['data'] = $this->account_model->save(0,$record);
					if($result['data']['success'] == 1){
						$result['success'] = 1;
						$result['message'] = "User Registered Successfully.";
					}else{
						$result['error'] = 1;
						$result['message']="User Registration failed.";
					}
					$result['message'] = "Form Validation successful";
					
			}else{
				$this->form_validation->set_error_delimiters('<div style="color:red!important">', '</div>');
				$result['error'] =1;
				$result['message'] = "Form Validation failed.";
				$result['errorCode'] = 101;
				$result['data'] = ["fname"=>form_error('fname'),"lname"=>form_error('lname'),"email"=>form_error('email'),"pass"=>form_error('pass'),"phone"=>form_error('phone')];
			}
		}else{
			$result['error'] = 1;
			$result['message'] = 'Invalid request.';
		}
		echo json_encode($result);
	}
	


	public function process_login(){
		$result = array("success"=>0,"error"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('email','Email','required|trim');
			$this->form_validation->set_rules('password','Password','required|trim');
			if($this->form_validation->run() == TRUE){
				$record = [];
				$record['email'] = $this->input->post('email'); 
				$record['pass'] = md5($this->input->post('password'));
				$checkUser=$this->account_model->is_valid_user($record);
				if($checkUser['success'] == 1){
					$user = $checkUser['data'][0];
					$result['success'] = 1;
					$sess_array = array();
					$sess_array = array(
						'sessUserId' => $user['id'],
						'sessUserFname' => $user['fname'],
						'sessUserLname' => $user['lname'],
						'sessUserEmail' => $user['email'],
						'sessUserPhone' => $user['phone'],
						'sessUserCreatedAt' => $user['created_at'],
						'sessUserUpdatedAt' => $user['updated_at'],
						'sessUserLastLoggedInAt' => $user['last_loggedin_at']
					);
					$this->session->set_userdata($sess_array);
					$this->account_model->login_process($user['id']);

				}else{
					$result['error'] = 1;
					// $result['message']="User Not Found.";
					$result['errorCode'] = 102;
				}
			}else{
				$result['error'] = 1;
				$result['errorCode'] = 101;
				// $result['message']="Form Validation failed.";
				$result['data'] = ["email"=>form_error('email'),"pass"=>form_error('password')];
			}
		}else{
			$result['error'] = 1;
			
			$result['message'] = 'Invalid request.';
	}
	echo json_encode($result);
}

	public function process_logout(){
		$result = array("success"=>0,"error"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			if($this->session->userdata('sessUserId') <> 0  || $this->session->userdata('sessUserId') == ""){
				$sess_array = array(
					'sessUserId',
					'sessUserFname',
					'sessUserLname',
					'sessUserEmail',
					'sessUserCreatedAt',
					'sessUserUpdatedAt',
					'sessUserLastLoggedInAt'
				);
				$this->account_model->logout_process($this->session->userdata('sessUserId'));
				$this->session->unset_userdata($sess_array);
				$result['success'] = 1;
				$result['message'] = "logout successful";	
			}else{
				$result['error'] = 1;
				$result['message']="Something went Wrong";
			}
		}
			echo json_encode($result);
	}

	public function forgot_password(){
		$result = array("success"=>0,"error"=>0,"errorCode"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('forget_email','Email','required|trim|min_length[6]|max_length[50]|valid_email|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
			$this->form_validation->set_error_delimiters('<div style="color:red!important">', '</div>');
			if($this->form_validation->run() == TRUE){
				$user_data = [];
				$user_data['email'] = $this->input->post('forget_email');
				$user_data['recoveryKey'] = rand(111111111,999999999);
				$result['data'] = $this->account_model->reset_password($user_data);
				if($result['data']['success'] == 1){
					$recoveryKey = $this->session->flashdata('recoveryKey');
					$result['success'] = 1;
					$link = base_url()."account/reset_password/".$recoveryKey."";
					$result['data']['link'] = $link;
				}else{
					$result['error'] = 1;
					$result['message'] = "Email not Found";
					$result['errorCode'] = 101;
				}	
			}
		}else{
			$result['error'] =1;
			$result['message'] = "Invalid Request";
			$result['data'] = form_error('forget_email');
		}
		echo json_encode($result);
	}

	public function reset_password($key = ''){
		$result = array("success"=>0,"error"=>0,"errorCode"=>0,"message"=>"","data"=>array());	
		if($key <> ''){
			$result['data'] = $this->account_model->checkRecoveryKey($key);
			if($result['data']['success'] == 1){
					$update_password = [];
					$update_password['key'] = $key;
					$new_pass = rand(1000000,99999999);
					$update_password['pass'] = md5($new_pass);
					$update_password['data'] = $this->account_model->update_password($update_password);
					if($update_password['data']['success'] == 1){
						echo "Your new password is = ".$new_pass;
					}else{
						echo "password not updated";
					}
			}else{
				echo "The link was expired";
			}
		}else{
			echo "Oops! Invalid Request";
		}
	}


	public function update_account(){	
		$result = array("success"=>0,"error"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('email','Email','required|trim|min_length[6]|max_length[50]|valid_email|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
			$this->form_validation->set_rules('phone','Phone Number','required|trim|exact_length[10]|numeric');
			if($this->form_validation->run() == TRUE){
					$record = [];
					$check_duplicate_email = $this->account_model->check_duplicate_email($this->input->post('email'),$this->session->userdata('sessUserId'));
					if($check_duplicate_email['success'] == 1){
						$record['email'] = $this->input->post('email');
						$record['phone'] = $this->input->post('phone');
						$save_result = $this->account_model->save($this->session->userdata('sessUserId'),$record);
						if($save_result['success'] == 1){
							$result['success'] = 1;
							$result['message'] = "Profile Updated Successfully.";
							
						}else{
							$result['error'] = 1;
							$result['message']="Something Went Wrong.";
						}		
					}else{
						$result['error'] = 1;
						$result['errorCode'] = 102;
						$result['message'] = "Email Already Exists";
					}
			}else{
				$result['error'] =1;
				$result['message'] = "Form Validation failed.";
				$result['errorCode'] = 101;
				$result['data'] = ["email"=>form_error('email'),"phone"=>form_error('phone')];
			}
		}else{
			$result['error'] = 1;
			$result['message'] = 'Invalid request.';
		}
		echo json_encode($result);	
	}	


	public function account_details(){
		$result = array("success"=>0,"error"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			$result['data'] = $this->account_model->get_userdata($this->session->userdata('sessUserId'));
			if($result['data']['success'] == 1){
				$result['success'] == 1;
			}else{
				$result['error'] == 1;
			}
		}
		echo json_encode($result);
	}

	public function is_valid_password(){
		$result = array("success"=>0,"error"=>0,"errorCode"=>0,"message"=>"","data"=>array());
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('new_pass','Password','required|trim|min_length[6]|max_length[20]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/]');
			if($this->form_validation->run() == TRUE){
				$user_data = [];

				$user_data['old_pass'] = md5($this->input->post('old_pass'));
				$user_data['new_pass'] = $this->input->post('new_pass');
				$user_data['confirm_pass'] = $this->input->post('confirm_pass');
				if($this->account_model->is_valid_password($this->session->userdata('sessUserEmail'),$user_data)){
				if($user_data['new_pass'] == $user_data['confirm_pass']){
					$result['data'] = $this->account_model->update_user_password($this->session->userdata('sessUserId'),md5($user_data['new_pass']));
					if($result['data']['success'] == 1){
					$result['success'] == 1;
				}else{
					$result['error'] == 1;
					$result['message'] = "Password Not Updated";
					$result['errorCode'] = 103;
				}
			}else{
				$result['error'] = 1;
				$result['errorCode'] = 101;
				$result['message'] = "New Password And Conform password not matched";
			}
			}else{
				$result['error'] = 1;
				$result['errorCode'] = 102;
				$result['message'] = "Password Not Matched";
			}
		}else{
			$result['error'] = 1;
			$result['errorCode'] = 104;
			$result['data'] = ["new_password_error"=>form_error('new_pass')];
		}
		}
		echo json_encode($result);
	}

}



?>
