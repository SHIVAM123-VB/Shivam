<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class account_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function is_valid_user($uname_email, $password){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		$users = $this->db->query("SELECT * FROM admin WHERE (uname='" . $uname_email . "' OR email='" . $uname_email . "') AND password='" . md5($password) . "'");
		if ($users->num_rows() == 1) {
			$user = $users->row_array();
			if ($user['status'] != 'active') {
				$result['error'] = 1;
				$result['message'] = "Oops! Your account is not active.";
			} else if (($user['uname'] == $uname_email || $user['email'] == $uname_email) && $user['password'] == md5($password)) {
				$result['data']['user'] = $user;
				$result['success'] = 1;
				$result['message'] = "Login Successful.";
			} else {
				$result['error'] = 1;
				$result['message'] = "Oops! Something went wrong.";
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Oops! Invalid Credentials.";
		}
		return $result;
	}

	function login_processed($userId){
		if ($this->db->query("UPDATE admin SET last_loggedin_at=now() WHERE id='" . $userId . "' ")) {
			return true;
		} else {
			return false;
		}
	}

	function logout_processed($userId){
		if ($this->db->query("UPDATE admin SET last_loggedin_at=now() WHERE id='" . $userId . "' ")) {
			return true;
		} else {
			return false;
		}
	}

	function update_account($userId, $fname, $lname, $profilePicture, $uname, $email, $password, $cpassword){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());

		if ($this->ideate_model->is_unique_field("admin", "uname", $uname, $userId)) {
			if ($this->ideate_model->is_unique_field("admin", "email", $email, $userId)) {
				$updateUser = "UPDATE admin SET fname='" . quotes_to_entities($fname) . "', lname='" . quotes_to_entities($lname) . "', uname='" . quotes_to_entities($uname) . "', email='" . $email . "' ";
				if ($password <> "" && $password == $cpassword) {
					$updateUser .= ", password='" . md5($password) . "' ";
				}
				if ((trim($profilePicture) <> "")) {
					$updateUser .= ", profile_picture='" . trim($profilePicture) . "' ";
				}
				$updateUser .= ", updated_by=" . $this->admin_model->loggedInAdminId . ", updated_at=NOW() WHERE id='" . $userId . "'";

				if ($this->db->query($updateUser)) {

					if ($this->ideate_model->settings['site_info_sender'] == 1) {
						$this->admin_model->get_site_info();
					}

					$result['success'] = 1;
					$updatedUserData = $this->ideate_model->get_row("admin", "fname,lname,uname,email,profile_picture,updated_at", "id='" . $userId . "'");
					$result['data']['fname'] = $updatedUserData['fname'];
					$result['data']['lname'] = $updatedUserData['lname'];
					$result['data']['uname'] = $updatedUserData['uname'];
					$result['data']['email'] = $updatedUserData['email'];
					$result['data']['profile_picture'] = $updatedUserData['profile_picture'];
					$result['data']['updated_at'] = $updatedUserData['updated_at'];
					$result['message'] = "Your account has been updated successfully !";
				} else {
					$result['error'] = 1;
					$result['message'] = "Failed to update your account.";
				}
			} else {
				$result['error'] = 1;
				$result['message'] = "Entered Email id already exists.";
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Entered Username already exists.";
		}
		return $result;
	}

	function reset_password($userEmail){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		$user = $this->ideate_model->get_row("admin", "email,fname", "email='" . $userEmail . "'");
		if ($user) {
			$password = random_string('alnum', 12);
			$resetPassword = "UPDATE admin SET password='" . md5($password) . "' WHERE email='" . $userEmail . "'";
			if ($this->db->query($resetPassword)) {
				$mailFromEmail = SITE_OUTGOING_EMAIL;
				$mailFromName = SITE_NAME;
				$mailTo = $user['email'];
				$mailSubject = SITE_NAME . " - Administrator password reset successfully.";
				$pageData = array();
				$pageData['title'] = $mailSubject;
				$pageData['data']['fname'] = $user['fname'];
				$pageData['data']['newPassword'] = $password;
				$mailContent = $this->load->view(SITE_ADMIN_DIR_NAME . "/common/mail_templates/forget_password", array("pageData" => $pageData), true);

				$this->email->from($mailFromEmail, $mailFromName);
				$this->email->to($mailTo);
				$this->email->subject($mailSubject);
				$this->email->message($mailContent);
				$this->email->send();

				$result['success'] = 1;
				$result['message'] = "Your password has been reset! Please check your inbox/spam folder for new password.";
			} else {
				$result['error'] = 1;
				$result['message'] = "Failed to reset your password.";
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Entered email id does not exist.";
		}
		return $result;
	}
}