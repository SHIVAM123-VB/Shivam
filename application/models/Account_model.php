<?php


class account_model extends CI_Model
{


	public function save($record_id, $record)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", "data" => []];

		$arrSaveRecordFields = [];
		foreach ($record as $recordFieldName => $recordFieldValue) {
			$arrSaveRecordFields[] = "`" . $recordFieldName . "`='" . strEscape($recordFieldValue) . "'";
		}
		$strSaveRecordFields = implode(", ", $arrSaveRecordFields);
		if ($record_id <> 0 && $record_id > 0) {
			$sql = "UPDATE users SET $strSaveRecordFields, updated_at=NOW() ,updated_by='$record_id' WHERE id = '" . $record_id . "' ";
		} else {
			$sql = "INSERT INTO users SET $strSaveRecordFields,`created_at`=NOW()";
		}

		if ($this->db->query($sql)) {
			if ($record_id <> 0 && $record_id > 0) {
				$response['success'] = 1;
				$response['message'] = "Record Updated successfully";
				$response['data']['recordID'] = $record_id;
			} else {
				$response['success'] = 1;
				$response['message'] = "Record Inserted successfully";
				$response['data']['recordID'] = $this->db->insert_id();
			}
		} else {
			$response['error'] = 1;
			$response['message'] = "Failed to Save";
		}
		return $response;
	}

	public function is_valid_user($user_data)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", "data" => []];
		$email = $user_data['email'];
		$pass = $user_data['pass'];
		$sql = $this->db->query("SELECT * FROM users WHERE `email`='$email' AND `password`='$pass'");
		if ($sql->num_rows() == 1) {
			if ($sql->row()->status == "active") {
				$user = $sql->result_array();
				$response['success'] = 1;
				$response['data'] = $user;
			} else {
				$response['error'] = 1;
				$response['message'] = "User not Found";
			}
		} else {
			$response['error'] = 1;
			$response['message'] = "User not Found";
		}
		return $response;
	}

	public function login_process($user_id)
	{
		if ($user_id <> "" && $user_id <> 0) {
			if ($this->db->query("UPDATE users SET last_loggedin_at = NOW()  WHERE id = '" . $user_id . "'")) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function logout_process($user_id)
	{
		if ($this->db->query("UPDATE users SET last_loggedin_at = NOW() WHERE id = '" . $user_id . "'")) {
			return true;
		} else {
			return false;
		}
	}


	public function reset_password($user_data)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", "data" => []];
		$email = strEscape($user_data['email']);
		$sql = $this->db->query("SELECT email FROM users WHERE email = '$email'");
		if ($sql->num_rows() == 1) {
			if ($this->db->query("UPDATE users SET recovery_key = '$user_data[recoveryKey]' WHERE email = '$email'")) {
				$response['success'] = 1;
				$response['message'] = "Recovery key added";
				$this->session->set_flashdata('recoveryKey', $user_data['recoveryKey']);
			}
		} else {
			$response['error'] = 1;
			$response['message'] = "Email not found";
		}
		return $response;
	}


	public function checkRecoveryKey($recoveryKey)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", "data" => []];
		$sql = $this->db->query("SELECT recovery_key FROM users WHERE recovery_key = '$recoveryKey'");
		if ($sql->num_rows() == 1) {
			$response['success'] = 1;
		} else {
			$response['error'] = 1;
		}
		return $response;
	}

	public function update_password($update_password)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", "data" => []];
		$sql = $this->db->query("UPDATE users SET `password`	= '$update_password[pass]' WHERE recovery_key = '$update_password[key]'");
		if ($sql) {
			$response['success'] = 1;
		} else {
			$response['error'] = 1;
			$response['message'] = "password not updated";
		}
		return $response;
	}

	public function get_userdata($id)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		$sql = $this->db->query("SELECT fname,lname,email,phone FROM users WHERE id='" . $id . "'");
		if ($sql->num_rows() > 0) {
			$response['success'] = 1;
			$response['data'] = $sql->result_array();
		} else {
			$response['error'] = 1;
			$response['message'] = "no Data Found";
		}
		return $response;
	}

	public function is_valid_password($email, $user_data)
	{
		if ($email <> "") {
			$sql = 	$this->db->query("SELECT email,`password` FROM users WHERE email = '$email' AND `password`= '$user_data[old_pass]'");
			if ($sql->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
		}
	}
	public function update_user_password($id, $new_pass)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		$sql = $this->db->query("UPDATE users SET `password`='$new_pass',updated_by = '$id' WHERE id='$id'");
		if ($sql) {
			$response['success'] = 1;
		} else {
			$response['error'] = 1;
			$response['message'] = "Password not Updated";
		}
		return $response;
	}

	public function check_duplicate_email($email, $id)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		$sql = $this->db->query("SELECT email from users WHERE email like '$email' AND id <> '$id'");
		if ($sql->num_rows() > 0) {
			$response['error'] = 1;
		} else {
			$response['success'] = 1;
		}
		return $response;
	}
}
