<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model
{

	public function save($recordId, $record)
	{
		$result = array('success' => 0, 'error' => 1, 'message' => '', 'data' => array());
		$arrSaveRecordFields = [];
		foreach ($record as $fields => $value) {
			$arrSaveRecordFields[] = "`" . $fields . "`='" . strEscape($value) . "'";
		}
		$strSaveRecordFields = implode(',', $arrSaveRecordFields);
		if ($recordId <> 0 && $recordId <> "") {
			$sql = "UPDATE ".$this->tablename." SET $strSaveRecordFields,updated_at = NOW(),updated_by=" . $this->admin_model->loggedInAdminId . " WHERE id='" . $recordId . "'";
		} else {
			$sql = "INSERT INTO ".$this->tablename." SET $strSaveRecordFields,created_at = NOW(),created_by=" . $this->admin_model->loggedInAdminId . "";
		}
		if ($this->db->query($sql)) {
			$result['success'] = 1;
			if ($recordId <> "" && $recordId > 0) {
				$result['data']['recordId'] = $recordId;
			} else {
				$result['data']['recordId'] = $this->db->insert_id();
			}
			$result['message'] = "Userdata saved successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to save Userdata";
		}

		return $result;
	}

	public function delete($recordId)
	{
		$result = array('success' => 0, 'error' => 1, 'message' => '', 'data' => array());
		$deleteRecordQuery = "UPDATE " . $this->tablename . " SET status = 'trash',updated_by='" . $this->admin_model->loggedInAdminId . "',updated_at=NOW()  WHERE id = '" . $recordId . "'";
		if ($this->db->query($deleteRecordQuery)) {
			$result['success'] = 1;
			$result['message'] = "User deleted successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to delete User";
		}
		return $result;
	}

	
}
