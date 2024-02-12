<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class product_model extends CI_Model
{
	public function get_categories(){
		$response = ['success'=>0,"error"=>0,"message"=>"",'data'=>[]];
		$sql = $this->db->query("SELECT `id`,`name` FROM `categories`  WHERE status!='trash' ORDER BY `name`");
		if($sql->num_rows()>0){
			$response['data'] = $sql->result_array();
			$response['success'] = 1;
		}else{
			$response['error'] = 1;
		}
		// echo "<pre>";
		//  print_r($sql->result_array());
		return $response;
	}

	public function save($recordId, $record)
	{
		$result = array('success' => 0, 'error' => 1, 'message' => '', 'data' => array());
		$arrSaveRecordFields = [];
		foreach ($record as $fields => $value) {
			$arrSaveRecordFields[] = "`" . $fields . "`='" . strEscape($value) . "'";
		}
		$strSaveRecordFields = implode(',', $arrSaveRecordFields);
		if ($recordId <> 0 && $recordId <> "") {
			$sql = "UPDATE " . $this->tablename . " SET $strSaveRecordFields,updated_at = NOW(),updated_by=" . $this->admin_model->loggedInAdminId . " WHERE id='" . $recordId . "'";
		} else {
			$sql = "INSERT INTO " . $this->tablename . " SET $strSaveRecordFields,created_at = NOW(),created_by=" . $this->admin_model->loggedInAdminId . "";
		}
		if ($this->db->query($sql)) {
			$result['success'] = 1;
			if ($recordId <> "" && $recordId > 0) {
				$result['data']['recordId'] = $recordId;
			} else {
				$result['data']['recordId'] = $this->db->insert_id();
			}
			$result['message'] = $this->labelSingular." saved successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to save ".$this->labelSingular;
		}

		return $result;
	}

	function delete($recordId)
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		// $this->ideate_model->delete_uploaded_file($this->tablename, "profile_picture", $recordId, "data/admin_profile_pictures/");
		$deleteRecordQuery = "UPDATE " . $this->tablename . " SET status='trash', updated_at=NOW(), updated_by='" . $this->admin_model->loggedInAdminId . "' WHERE id='" . $recordId . "'";
		if ($this->db->query($deleteRecordQuery)) {
			$result['success'] = 1;
			$result['message'] = $this->labelSingular . " deleted successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to delete " . $this->labelSingular . ".";
		}
		return $result;
	}

}
