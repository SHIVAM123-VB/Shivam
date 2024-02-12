<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_users_model extends CI_Model{

	var $labelSingular;
	var $labelPlural;
	var $tableName;

	function __construct(){
		parent::__construct();
		$this->labelSingular = "Admin User";
		$this->labelPlural = "Admin Users";
		$this->tableName = "admin";
	}

	function save($recordId, $record){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());

		if (!$this->ideate_model->is_unique_field($this->tableName, "uname", $record['uname'], $recordId)) {
			$result['error'] = 1;
			$result['message'] = "Entered Username already exists.";
		} elseif (!$this->ideate_model->is_unique_field($this->tableName, "email", $record['email'], $recordId)) {
			$result['error'] = 1;
			$result['message'] = "Entered Email already exists.";
		} else {
			$arrSaveRecordFields = array();
			foreach ($record as $recordFieldName => $recordFieldValue) {
				/*if($recordFieldName=="")
				{
					$arrSaveRecordFields[]="`".$recordFieldName."`='".$recordFieldValue."'";
				}
				else*/ {
					$arrSaveRecordFields[] = "`" . $recordFieldName . "`='" . strEscape($recordFieldValue) . "'";
				}
			}
			$strSaveRecordFields = implode(", ", $arrSaveRecordFields);

			if ($recordId <> "" && $recordId > 0) {
				$saveRecordQuery = "UPDATE " . $this->tableName . " SET " . $strSaveRecordFields . ", updated_by=" . $this->admin_model->loggedInAdminId . ", updated_at=NOW() WHERE id='" . $recordId . "'";
			} else {
				$saveRecordQuery = "INSERT INTO " . $this->tableName . " SET " . $strSaveRecordFields . ", created_by=" . $this->admin_model->loggedInAdminId . ", created_at=NOW()";
			}

			if ($this->db->query($saveRecordQuery)) {
				$result['success'] = 1;
				if ($recordId <> "" && $recordId > 0) {
					$result['data']['recordId'] = $recordId;
				} else {
					$result['data']['recordId'] = $this->db->insert_id();
				}
				$result['message'] = $this->labelSingular . " saved successfully.";
			} else {
				$result['error'] = 1;
				$result['message'] = "Failed to save " . $this->labelSingular . ".";
			}
		}
		return $result;
	}

	function delete($recordId){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());

		$this->ideate_model->delete_uploaded_file($this->tableName, "profile_picture", $recordId, "data/admin_profile_pictures/");

		$deleteRecordQuery = "UPDATE " . $this->tableName . " SET status='trash', updated_at=NOW(), updated_by='" . $this->admin_model->loggedInAdminId . "' WHERE id='" . $recordId . "'";
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